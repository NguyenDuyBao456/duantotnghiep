import { CardProductComponent } from './../../components/card-product/card-product.component';
import { Component, OnInit } from '@angular/core';
import { NavbarComponent } from '../../components/navbar/navbar.component';
import { FooterComponent } from '../../components/footer/footer.component';
import { ProductService } from '../../services/product.service';
import { CategoryService } from '../../services/category.service';
import { concatMap, forkJoin, of } from 'rxjs';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CardProductComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
})
export class HomeComponent implements OnInit {
  products: any;
  outstanding: any;

  constructor(
    private productService: ProductService,
    private categoryService: CategoryService
  ) {}

  ngOnInit(): void {
    this.getProduct();
    this.getOutStanding();
  }

  getProduct() {
    forkJoin([
      this.categoryService.getCategory(),
      this.productService.getProduct(),
    ])
      .pipe(
        concatMap(([categories, products]: [category: any, product: any]) => {
          return of(
            categories.map((cate: any) => {
              return {
                ...cate,
                products: products
                  .filter((prod: any) => prod.categories_id === cate.id)
                  .slice(0, 8),
              };
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.products = data;

        console.log(this.products);
      });
  }

  getOutStanding() {
    this.productService.getProduct().subscribe((data: any) => {
      this.outstanding = data.reverse().slice(0, 4);
    });
  }
}
