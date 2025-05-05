import { CommonModule, DecimalPipe } from '@angular/common';
import { Component, Input, OnInit } from '@angular/core';
import { CartService } from '../../services/cart.service';
import { UserService } from '../../services/user.service';
import { PreviewService } from '../../services/preview.service';
import { environment } from '../../../environments/environment';

@Component({
  selector: 'app-card-product',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './card-product.component.html',
  styleUrl: './card-product.component.css',
  providers: [],
})
export class CardProductComponent implements OnInit {
  url: string = environment.apiUrl;

  @Input() product: any;

  star: any;

  constructor(
    private cartService: CartService,
    private userService: UserService,
    private previewService: PreviewService
  ) {}

  ngOnInit(): void {
    this.getStar();
  }

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

  getStar() {
    this.previewService
      .getPreviewByProduct(this.product.id)
      .subscribe((data: any) => {
        if (data.length === 0) {
          this.star = Array(5).fill(1);
          return;
        }
        const gold = Array(
          Math.ceil(
            data.reduce((init: number, item: any) => item.Rating + init, 0) /
              data.length
          )
        ).fill(0);
        const gray = Array(5 - gold.length).fill(1);

        this.star = [...gold, ...gray];

        if (
          Number.isInteger(
            data.reduce((init: number, item: any) => item.Rating + init, 0) /
              data.length
          )
        ) {
          this.star[
            Math.ceil(
              data.reduce((init: number, item: any) => item.Rating + init, 0) /
                data.length
            ) - 1
          ] = 0;
        } else {
          this.star[
            Math.ceil(
              data.reduce((init: number, item: any) => item.Rating + init, 0) /
                data.length
            ) - 1
          ] = 2;
        }
        console.log(this.star);
      });
  }
}
