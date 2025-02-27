import { Component, CUSTOM_ELEMENTS_SCHEMA, OnInit } from '@angular/core';
import { ProductService } from '../../services/product.service';
import { ActivatedRoute, Params } from '@angular/router';
import { concatMap } from 'rxjs';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { CartService } from '../../services/cart.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-details',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './details.component.html',
  styleUrl: './details.component.css',
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})
export class DetailsComponent implements OnInit {
  details: any;
  qty: number = 1;

  ngOnInit(): void {
    this.getProduct();
  }

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private cartService: CartService
  ) {}

  getProduct() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowEscapeKey: false,
    });

    this.route.params
      .pipe(
        concatMap((params: Params) => {
          return this.productService.getOneProduct(params['id']);
        })
      )
      .subscribe(
        (data: any) => {
          this.details = data;

          Swal.close();
        },
        (error) => {
          location.href = '/404';
        }
      );
  }

  addToCart(data: any) {
    console.log(data);

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
