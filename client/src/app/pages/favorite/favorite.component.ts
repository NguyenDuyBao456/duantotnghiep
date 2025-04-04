import { Component, OnInit } from '@angular/core';
import { CardProductComponent } from '../../components/card-product/card-product.component';
import { FavoriteService } from '../../services/favorite.service';
import { UserService } from '../../services/user.service';
import { concatMap, forkJoin, map, of } from 'rxjs';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-favorite',
  standalone: true,
  imports: [CardProductComponent],
  templateUrl: './favorite.component.html',
  styleUrl: './favorite.component.css',
})
export class FavoriteComponent implements OnInit {
  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';

  favorites: any;

  constructor(
    private favoriteService: FavoriteService,
    private userService: UserService,
    private productService: ProductService
  ) {}

  ngOnInit(): void {
    this.getFavorite();
  }

  getFavorite() {
    this.userService
      .decoded(this.token)
      .pipe(
        concatMap((user: any) => {
          return this.favoriteService.getFavoriteUser(user.id);
        }),
        concatMap((favorites: any) => {
          if (!favorites.length) {
            return of([]);
          }

          return forkJoin(
            favorites.map((item: any) => {
              return this.productService.getOneProduct(item.id_product).pipe(
                map((product: any) => {
                  return {
                    product,
                    item,
                  };
                })
              );
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.favorites = data;
      });
  }
}
