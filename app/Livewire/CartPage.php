<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart-VShop')]
class CartPage extends Component
{
    public $cart_items = [];
    public $total_price;

    public function mount(){
        $this->cart_items = CartManagement::getCartItems();
        $this->total_price = CartManagement::calculateTotalPrice($this->cart_items);
    }

    public function removeItem($product_id){
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->total_price = CartManagement::calculateTotalPrice($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id){
        $this->cart_items = CartManagement::incrementItemQuantity($product_id);
        $this->total_price = CartManagement::calculateTotalPrice($this->cart_items);
    }

    public function decreaseQty($product_id){
        $this->cart_items = CartManagement::decrementItemQuantity($product_id);
        $this->total_price = CartManagement::calculateTotalPrice($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
