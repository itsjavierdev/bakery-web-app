<?php

namespace App\Livewire\Admin\Parameters\CompanyContact;

use App\Models\Address;
use App\Models\CompanyContact;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Update extends Component
{
    public $company_contact;
    public $address;

    #[Rule('nullable|integer|min:60000000|max:80090000', as: 'teléfono')]
    public $phone;
    #[Rule('nullable|string|email|max:255', as: 'correo electronico')]
    public $email;
    #[Rule('nullable|string|min:5|max:100', as: 'dirección')]
    public $new_address;
    #[Rule('nullable|url', as: 'tiktok')]
    public $tiktok;
    #[Rule('nullable|url', as: 'instagram')]
    public $instagram;
    #[Rule('nullable|url', as: 'facebook')]
    public $facebook;

    public function mount()
    {
        $this->company_contact = CompanyContact::find(1);
        $this->phone = $this->company_contact->phone;
        $this->email = $this->company_contact->email;
        $this->address = Address::find($this->company_contact->address_id) ?? null;
        if ($this->address) {
            $this->new_address = $this->address->address;
        }
        $this->tiktok = $this->company_contact->tiktok;
        $this->instagram = $this->company_contact->instagram;
        $this->facebook = $this->company_contact->facebook;
    }

    public function update()
    {
        $this->validate();
        if ($this->address != null) {
            $this->address->update([
                'address' => $this->new_address,
            ]);
        } elseif ($this->new_address != null) {
            $this->address = Address::create([
                'address' => $this->new_address,
            ]);
        }

        $this->company_contact->update([
            'phone' => $this->phone,
            'email' => $this->email,
            'tiktok' => $this->tiktok,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'address_id' => $this->address->id ?? null,
        ]);

        return redirect()->to('admin/informacion')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Contacto de la empresa actualizado correctamente');

    }

    public function render()
    {
        return view('livewire.admin.parameters.company-contact.update')->layout('layouts.admin-header', ['title' => 'Actualizar contacto de la empresa', 'titleAlign' => 'center']);
    }

    public function messages()
    {
        return [
            'phone.integer' => 'El campo telefono solo puede contener números.',
            'phone.min' => 'El campo telefono no es un telefono valido.',
            'phone.max' => 'El campo telefono no es un telefono valido.',
            'tiktok.url' => 'El enlace de TikTok debe ser una URL válida',
            'instagram.url' => 'El enlace de Instagram debe ser una URL válida',
            'facebook.url' => 'El enlace de Facebook debe ser una URL válida',
        ];
    }
}
