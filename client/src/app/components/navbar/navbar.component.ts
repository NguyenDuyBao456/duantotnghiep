import { Component, OnInit } from '@angular/core';
import { CategoryService } from '../../services/category.service';
import { SubcategoriesService } from '../../services/subcategories.service';
import { concatMap, forkJoin, of } from 'rxjs';
import { CartService } from '../../services/cart.service';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css',
})
export class NavbarComponent implements OnInit {
  category: any;
  cart: any;
  user: any = localStorage.getItem('user')
    ? JSON.parse(localStorage.getItem('user') || '')
    : '';

  ngOnInit(): void {
    this.getCategory();
    this.getCart();
  }

  constructor(
    private categoryService: CategoryService,
    private subCategoriesService: SubcategoriesService,
    private cartService: CartService
  ) {}

  getCategory() {
    forkJoin([
      this.categoryService.getCategory(),
      this.subCategoriesService.getSubCategories(),
    ])
      .pipe(
        concatMap(([category, subcategories]: any) => {
          return of(
            category.map((cate: any) => {
              return {
                ...cate,
                subcategories: subcategories.filter((subcate: any) => {
                  return subcate.categories_id === cate.id;
                }),
              };
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.category = data;
      });
  }

  getCart() {
    this.cartService.currentCart.subscribe((data) => {
      this.cart = data.length;
    });
  }
}
