import { Component, OnInit } from '@angular/core';
import { CartService } from '../../services/cart.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-cart',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './cart.component.html',
  styleUrl: './cart.component.css',
})
export class CartComponent implements OnInit {
  cart: any;
  total: number = 0;

  ngOnInit(): void {
    this.getCart();
    this.getTotal();
  }

  constructor(private cartService: CartService) {}

  getCart() {
    this.cart = JSON.parse(localStorage.getItem('cart') || '');
    console.log(this.cart);
  }

  UpdateQty(qty: any, index: number) {
    this.cart[index].qty = +qty.value;

    this.cartService.setCart(this.cart);
    this.getTotal();
  }

  deleteCart(index: number) {
    this.cart = JSON.parse(localStorage.getItem('cart') || '');

    this.cart.splice(index, 1);
    this.cartService.setCart(this.cart);
    this.getTotal();
  }

  getTotal() {
    this.total = this.cart.reduce(
      (init: any, item: any) => item.details.price * item.qty + init,
      0
    );
  }
}
