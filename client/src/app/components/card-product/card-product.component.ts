import { CommonModule, DecimalPipe } from '@angular/common';
import { Component, Input } from '@angular/core';
import { CartService } from '../../services/cart.service';

@Component({
  selector: 'app-card-product',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './card-product.component.html',
  styleUrl: './card-product.component.css',
  providers: [],
})
export class CardProductComponent {
  @Input() product: any;

  constructor(private cartService: CartService) {}

  addToCart() {
    const data = { details: this.product, qty: 1 };

    if (!this.cartService.getCart()) {
      this.cartService.setCart([]);
    }

    const cart = JSON.parse(this.cartService.getCart() || '');

    console.log(cart);

    const check = cart.find((c: any) => c.details.id === data.details.id);

    if (check) {
      check.qty += data.qty;
    } else {
      cart.push(data);
    }

    this.cartService.setCart(cart);
  }
}
