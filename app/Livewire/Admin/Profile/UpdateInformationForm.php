<?php

namespace App\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Laravel\Jetstream\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UpdateInformationForm extends Component
{
    use WithFileUploads, InteractsWithBanner;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     *
     * @var bool
     */
    public $verificationLinkSent = false;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public $staff;
    public $role;

    //CI extensions
    public $extensions = [
        'SC',
        'LP',
        'CB',
        'OR',
        'PT',
        'TJ',
        'CH',
        'PA',
        'BN'
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->staff = $user->staff;

        $this->state = array_merge([
            'id' => $user->id,
            'role' => $user->roles->first(),
            'email' => $user->email,
            'name' => $this->staff->name,
            'surname' => $this->staff->surname,
            'phone' => $this->staff->phone,
            'CI_number' => substr($this->staff->CI, 0, 8),
            'CI_extension' => substr($this->staff->CI, -2),
            'CI' => $this->staff->CI,
            'birthdate' => $this->staff->birthdate,

        ], $user->withoutRelations()->toArray());

    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
            ? array_merge($this->state, ['photo' => $this->photo])
            : $this->state
        );
        $this->validate();
        $this->staff->update([
            'name' => $this->state['name'],
            'surname' => $this->state['surname'],
            'phone' => $this->state['phone'],
            'CI' => $this->state['CI'],
            'birthdate' => $this->state['birthdate'],
        ]);

        if (isset($this->photo)) {
            return redirect()->route('profile.show');
        }

        $this->banner('Perfil actualizado correctamente.');

        $this->dispatch('refresh-navigation-menu');
    }

    /**
     * Delete user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();

        $this->dispatch('refresh-navigation-menu');
    }

    /**
     * Sent the email verification.
     *
     * @return void
     */
    public function sendEmailVerification()
    {
        Auth::user()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.profile.update-profile-information-form');
    }

    //Custom rules
    public function rules()
    {
        $minDate = Carbon::now()->subYears(65)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(17)->format('Y-m-d');

        $this->state['CI'] = $this->state['CI_number'] . ' ' . $this->state['CI_extension'];

        return [
            'state.name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'state.surname' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'state.phone' => 'required|integer|min:60000000|max:80090000|unique:staff,phone,' . $this->staff->id,
            'state.CI_number' => 'required|string|regex:/^\d+$/|min:8|max:8',
            'state.CI_extension' => ['required', 'string', 'max:2', Rule::in(['SC', 'CB', 'LP', 'PO', 'OR', 'CH', 'TJ', 'BE', 'PA'])],
            'state.CI' => 'unique:staff,CI,' . $this->staff->id,
            'state.birthdate' => 'required|date|before:' . $maxDate . '|after:' . $minDate,
            'state.email' => ['required', 'string', 'email', 'max:255'],
        ];
    }
    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'state.name' => 'nombre',
            'state.surname' => 'apellido',
            'state.phone' => 'teléfono',
            'state.CI_number' => 'carnet de identidad',
            'state.CI_extension' => 'extensión',
            'state.CI' => 'carnet de identidad',
            'state.birthdate' => 'fecha de nacimiento',
            'state.email' => 'correo electrónico',
        ];
    }
    //Custom messages error
    public function messages()
    {
        return [
            'state.name.regex' => 'El campo nombre solo puede contener letras.',
            'state.surname.regex' => 'El campo nombre solo puede contener letras.',
            'state.phone.integer' => 'El campo telefono solo puede contener números.',
            'state.phone.min' => 'El campo telefono no es un telefono valido.',
            'state.phone.max' => 'El campo telefono no es un telefono valido.',
            'state.CI_number.regex' => 'El campo carnet de identidad solo puede contener números.',
            'state.birthdate.before' => 'La persona debe ser mayor de 17 años.',
            'state.birthdate.after' => 'La persona debe ser menor de 65 años.',
            'state.phone.number' => 'El teléfono debe ser un número.',
        ];
    }
}
