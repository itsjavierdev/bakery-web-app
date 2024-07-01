<?php

namespace App\Livewire\Customer\Order;

use App\Mail\NewOrder;
use App\Mail\OrderConfirmation;
use App\Models\Address;
use App\Models\CompanyContact;
use App\Models\DeliveryTime;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Livewire\Forms\Customer\Addresses\CheckoutAddress;
use Illuminate\Support\Facades\Auth;
use App\Facades\Cart as CartFacade;
use App\Models\Order;

class Checkout extends Component
{
    public CheckoutAddress $checkoutAddress;

    //Content
    public $cart;
    public $total;
    public $times;
    public $times_free;
    public $address;
    public $company_address;
    public $company_info;

    //validation rules
    public $delivery;
    public $delivery_time;
    public $delivery_date;
    public $description;
    public $delivery_date_time;

    public function render()
    {
        return view('livewire.customer.order.checkout');
    }

    public function mount()
    {
        //set the cart and select values
        $this->cart = CartFacade::get();
        $this->total = CartFacade::total();
        $this->address = Address::where('customer_id', Auth::guard('customer')->user()->customer->id)
            ->where('is_active', 1)
            ->first();

        //all times for pickup
        $this->times = DeliveryTime::where('available', 1)->orderBy('time', 'asc')->get();
        //just available times for delivery
        $this->times_free = DeliveryTime::where('for_delivery', 1)->where('available', 1)->orderBy('time', 'asc')->get();

        $this->company_info = CompanyContact::first();
        if ($this->company_info->address_id ?? false) {
            $this->company_address = Address::where('id', $this->company_info->address_id)->first();
        } else {
            $this->company_address;

        }

    }

    public function store()
    {
        $this->validate($this->rules(), [], $this->validationAttributes());
        //create the order
        $newOrder = new Order();
        $newOrder->total = $this->total;
        $newOrder->notes = $this->description;
        $newOrder->customer_id = Auth::guard('customer')->user()->customer->id;
        $newOrder->paid_amount = 0;
        $newOrder->picked_up = $this->delivery == 'pickup' ? 1 : 0;
        $newOrder->delivery_time_id = $this->delivery_time;
        $newOrder->delivery_date = $this->delivery_date;
        $newOrder->total_quantity = CartFacade::totalQuantity();

        //if delivery, save the address
        if ($this->delivery == 'delivery') {
            //if the customer doesn't have an address, save it with a form
            if ($this->address == null) {
                $this->checkoutAddress->save();
                $newOrder->address_id = $this->checkoutAddress->address->id;
            } else {
                //if the customer has an address, pick de choosen one
                $newOrder->address_id = $this->address->id;
            }
        }
        $newOrder->save();

        //save the order details
        foreach ($this->cart['products'] as $item) {
            $newOrderDetails = new OrderDetail();
            $newOrderDetails->order_id = $newOrder->id;
            $newOrderDetails->product_id = $item['id'];
            $newOrderDetails->quantity = $item['quantity'];
            $newOrderDetails->product_price = $item['price'];
            $newOrderDetails->subtotal = $item['subtotal'];
            $newOrderDetails->by_bag = true;
            $newOrderDetails->save();
        }
        Mail::to(Auth::guard('customer')->user()->customer->email)->send(new OrderConfirmation($newOrder));
        Mail::to($this->company_info->email)->send(new NewOrder($newOrder));

        //clear cart and redirect to thankyou page
        CartFacade::clear();
        return redirect()->route('customer.thankyou');
    }

    public function updatingDelivery()
    {
        $this->reset('delivery_time');
    }

    public function rules()
    {
        $rules = [
            'delivery' => 'required',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required',
        ];
        $delivery_time = DeliveryTime::where('id', $this->delivery_time)->first();
        if ($delivery_time && $this->delivery_date) {
            $this->delivery_date_time = Carbon::parse("$this->delivery_date $delivery_time->time");
            $rules['delivery_date_time'] = 'after_or_equal:now';
        }
        return $rules;
    }

    public function validationAttributes()
    {
        return [
            'delivery' => 'información de entrega',
            'delivery_time' => 'hora de entrega',
            'delivery_date' => 'fecha de entrega',
            'delivery_date_time' => 'Fecha y hora de entrega'
        ];
    }

    public function messages()
    {
        return [
            'delivery_date_time.after_or_equal' => 'La fecha y hora de entrega debe ser posterior a la actual',
            'delivery.required' => 'La información de entrega es requerida',
        ];
    }
}
