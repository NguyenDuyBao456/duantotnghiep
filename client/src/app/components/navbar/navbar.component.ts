import { Component, OnInit } from '@angular/core';
import { CategoryService } from '../../services/category.service';
import { SubcategoriesService } from '../../services/subcategories.service';
import { concatMap, forkJoin, of } from 'rxjs';
import { CartService } from '../../services/cart.service';
import { UserService } from '../../services/user.service';

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
  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';
  user: any;

  ngOnInit(): void {
    this.getUser();
    this.getCategory();
    this.getCart();
  }

  constructor(
    private categoryService: CategoryService,
    private subCategoriesService: SubcategoriesService,
    private cartService: CartService,
    private userService: UserService
  ) {}

  getUser() {
    this.userService.decoded(this.token).subscribe((data: any) => {
      this.user = data;

      this.cartService.currentCart.subscribe((data) => {
        if (!this.user) {
          this.cart = false;
        } else {
          this.cart = data.length;
        }
      });
    });
  }

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

  getCart() {}
}
