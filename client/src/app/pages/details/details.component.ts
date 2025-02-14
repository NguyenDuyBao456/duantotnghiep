import { Component, CUSTOM_ELEMENTS_SCHEMA, OnInit } from '@angular/core';
import { ProductService } from '../../services/product.service';
import { ActivatedRoute, Params } from '@angular/router';
import { concatMap } from 'rxjs';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

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
  loading: boolean = true;
  qty: number = 1;

  ngOnInit(): void {
    this.getProduct();
  }

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute
  ) {}

  getProduct() {
    this.route.params
      .pipe(
        concatMap((params: Params) => {
          return this.productService.getOneProduct(params['id']);
        })
      )
      .subscribe(
        (data: any) => {
          this.details = data;
          this.loading = false;
        },
        (error) => {
          location.href = '/404';
        }
      );
  }

  addToCart(data: any) {
    console.log(data);
  }
}
