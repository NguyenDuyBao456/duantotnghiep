import { Component, OnInit } from '@angular/core';
import { CardProductComponent } from '../../components/card-product/card-product.component';
import { ProductService } from '../../services/product.service';
import {
  ActivatedRoute,
  Router,
  RouterLink,
  RouterLinkActive,
} from '@angular/router';
import { concatMap, forkJoin, of } from 'rxjs';
import { SubcategoriesService } from '../../services/subcategories.service';

@Component({
  selector: 'app-product',
  standalone: true,
  imports: [CardProductComponent, RouterLink, RouterLinkActive],
  templateUrl: './product.component.html',
  styleUrl: './product.component.css',
})
export class ProductComponent implements OnInit {
  products: any;
  subcategory: any;
  index: number = 8;
  check: boolean = true;
  total: number = 0;

  isClickFilterPrice: any[] = [];

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private subCategoriesService: SubcategoriesService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.getProduct();
    this.getSubCategory();
  }

  viewMore() {
    this.index += 4;
    this.getProduct();
  }

  getProduct() {
    this.route.queryParams
      .pipe(
        concatMap((queryParams: any) => {
          console.log(queryParams);

          return this.productService.getProduct().pipe(
            concatMap((products: any) => {
              if (
                queryParams.min &&
                queryParams.max &&
                !queryParams.subcategories
              ) {
                console.log('Filter price');

                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category &&
                    product.price >= queryParams.min &&
                    product.price <= queryParams.max
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              } else if (
                queryParams.subcategories &&
                !queryParams.min &&
                !queryParams.max
              ) {
                console.log('Filter subcategories');

                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category &&
                    product.subcategories_id == queryParams.subcategories
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              } else if (
                queryParams.min &&
                queryParams.max &&
                queryParams.subcategories
              ) {
                console.log('Filter subcategories price');

                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category &&
                    product.price >= queryParams.min &&
                    product.price <= queryParams.max &&
                    product.subcategories_id == queryParams.subcategories
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              } else {
                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              }
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.products = data;

        if (this.total === data.length) {
          this.check = false;
        }
      });
  }

  getSubCategory() {
    // this.subCategoriesService
    //   .getSubCategories()
    //   .subscribe(
    //     (data: any) =>
    //       (this.subcategory = data.filter(
    //         (subcate: any) => subcate.categories_id === 1
    //       ))
    //   );

    this.route.queryParams
      .pipe(
        concatMap((queryParams: any) => {
          return this.subCategoriesService.getSubCategories().pipe(
            concatMap((subcategories: any) => {
              return of(
                subcategories.filter(
                  (subcate: any) =>
                    subcate.categories_id == queryParams.category
                )
              );
            })
          );
        })
      )
      .subscribe((data: any) => (this.subcategory = data));
  }

  filterPrice(min: number, max: number) {
    if (this.router.url.includes(`&min=${min}&max=${max}`)) {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { min: null, max: null },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          window.location.reload();
        });
    } else {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { min, max },
          queryParamsHandling: 'merge',
        })
        .then(() => this.getProduct());
    }
  }

  filterSubCategory(subcategories: number) {
    console.log(subcategories);

    if (this.router.url.includes(`&subcategories=${subcategories}`)) {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { subcategories: null },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          window.location.reload();
        });
    } else {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { subcategories },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          this.getProduct();
        });
    }
  }
}
