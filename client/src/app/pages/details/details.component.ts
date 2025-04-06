import {
  Component,
  CUSTOM_ELEMENTS_SCHEMA,
  EventEmitter,
  OnInit,
  Output,
} from '@angular/core';
import { ProductService } from '../../services/product.service';
import { ActivatedRoute, Params } from '@angular/router';
import { concatMap, forkJoin, of } from 'rxjs';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { CartService } from '../../services/cart.service';
import Swal from 'sweetalert2';
import { UserService } from '../../services/user.service';
import { CardProductComponent } from '../../components/card-product/card-product.component';
import { PreviewComponent } from '../../components/preview/preview.component';
import { PreviewService } from '../../services/preview.service';
import { FavoriteService } from '../../services/favorite.service';
import { OrderService } from '../../services/order.service';

@Component({
  selector: 'app-details',
  standalone: true,
  imports: [CommonModule, FormsModule, CardProductComponent, PreviewComponent],
  templateUrl: './details.component.html',
  styleUrl: './details.component.css',
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})
export class DetailsComponent implements OnInit {
  details: any;
  qty: number = 1;
  related: any;

  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';
  user: any;

  isOpenPreview: boolean = false;
  preview: any;
  avgPreview: any;
  starPreview: any;

  isFavorite: boolean = true;

  ngOnInit() {
    this.getProduct();
    this.activeFavorite();
    this.getUser();
    this.getRelated();
    this.getPreview();
  }

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private cartService: CartService,
    private userService: UserService,
    private previewService: PreviewService,
    private favoriteService: FavoriteService,
    private orderService: OrderService
  ) {}

  getPreview() {
    this.route.params
      .pipe(
        concatMap((params: Params) => {
          return forkJoin([
            this.previewService.getPreviewByProduct(params['id']),
            this.userService.getUser(),
            this.orderService.getOrder(),
          ]).pipe(
            concatMap(([previews, users, orders]: any) => {
              return of(
                previews.map((preview: any) => {
                  return {
                    ...preview,
                    rating: [
                      ...Array(preview.Rating).fill(0),
                      ...Array(5 - preview.Rating).fill(1),
                    ],
                    user: users.find(
                      (user: any) => user.id === preview.id_user
                    ),
                    check: orders
                      .map((order: any) => {
                        return order.details;
                      })
                      .flat()
                      .find((item: any) => item.id_product == params['id'])
                      ? true
                      : false,
                  };
                })
              );
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.preview = data;

        if (this.preview && this.preview.length > 0) {
          this.avgPreview = (
            this.preview.reduce(
              (init: number, item: any) => init + (item.Rating || 0),
              0
            ) / this.preview.length
          ).toFixed(1);

          this.starPreview = Array.from({ length: 5 }).map(
            (_: any, index: number) => {
              return [
                (100 / this.preview.length) *
                  this.preview.filter((item: any) => item.Rating === index + 1)
                    .length,
                this.preview.filter((item: any) => item.Rating === index + 1)
                  .length,
              ];
            }
          );
        } else {
          this.avgPreview = 0;

          this.starPreview = [
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
            [0, 0],
          ];
        }

        this.starPreview.reverse();
      });
  }

  getUser() {
    this.userService.decoded(this.token).subscribe((data: any) => {
      this.user = data;
    });
  }

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
        },
        (error) => {
          location.href = '/404';
        }
      );
  }

  addToCart(data: any) {
    if (!this.user) {
      location.href = '/login';
      return;
    }

    if (!this.cartService.getCart()) {
      this.cartService.setCart([]);
    }

    const cart = JSON.parse(this.cartService.getCart() || '');

    const check = cart.find((c: any) => c.details.id === data.details.id);

    if (check) {
      check.qty += data.qty;
    } else {
      cart.push(data);
    }

    this.cartService.setCart(cart);
  }

  getRelated() {
    this.route.params
      .pipe(
        concatMap((params: Params) => {
          return this.productService.getOneProduct(params['id']);
        }),
        concatMap((product: any) => {
          return this.productService.getProduct().pipe(
            concatMap((products: any) => {
              const data = products
                .filter(
                  (item: any) =>
                    item.categories_id === product.categories_id &&
                    item.id !== product.id
                )
                .slice(0, 4);

              return of(data);
            })
          );
        })
      )
      .subscribe(
        (data: any) => {
          this.related = data;
        },
        (error) => {
          location.href = '/404';
        }
      );
  }

  openPreview() {
    if (!this.user) {
      location.href = '/login';
      return;
    }

    const id = this.route.snapshot.params['id'];

    this.orderService
      .getOrder()
      .pipe(
        concatMap((orders: any) => {
          return of(
            orders
              .filter((item: any) => item.order.id_user === this.user.id)
              .map((item: any) => item.details)
              .flat()
          );
        })
      )
      .subscribe((data: any) => {
        if (data.find((item: any) => item.id_product == id)) {
          this.isOpenPreview = !this.isOpenPreview;
        } else {
          Swal.fire({
            text: 'Bạn chưa mua sản phẩm',
            icon: 'warning',
            allowOutsideClick: false,
          }).then(({ isConfirmed }) => {
            Swal.close();
          });
        }
      });
  }

  receiveMessage(event: any) {
    this.isOpenPreview = event;
  }

  addFavorite(data: any) {
    if (!this.user) {
      location.href = '/login';
      return;
    }

    this.favoriteService
      .getFavoriteUser(this.user.id)
      .pipe(
        concatMap((favorites: any) => {
          const check = favorites.find(
            (favorite: any) => favorite.id_product === data.details.id
          );

          if (check) {
            return this.favoriteService.destroyFavorite(check.MaYT);
          } else {
            return this.favoriteService.createFavorite({
              id_product: data.details.id,
              id_user: this.user.id,
            });
          }
        })
      )
      .subscribe((data: any) => {
        this.activeFavorite();
        this.favoriteService.favoriteUpdated.emit();
      });
  }

  activeFavorite() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    this.userService
      .decoded(this.token)
      .pipe(
        concatMap((user: any) => {
          return this.favoriteService.getFavoriteUser(user.id);
        })
      )
      .subscribe(
        (data: any) => {
          const check = data.find(
            (item: any) => item.id_product === this.details.id
          );

          this.isFavorite = !check;

          Swal.close();
        },
        (error: any) => {
          Swal.close();
        }
      );
  }
}
