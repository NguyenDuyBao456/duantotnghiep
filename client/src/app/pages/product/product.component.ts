import {
  AfterViewChecked,
  AfterViewInit,
  ChangeDetectorRef,
  Component,
  ElementRef,
  OnInit,
  QueryList,
  viewChildren,
  ViewChildren,
} from '@angular/core';
import { CardProductComponent } from '../../components/card-product/card-product.component';
import { ProductService } from '../../services/product.service';
import {
  ActivatedRoute,
  Router,
  RouterLink,
  RouterLinkActive,
  UrlSegmentGroup,
} from '@angular/router';
import { concatMap, forkJoin, of } from 'rxjs';
import { SubcategoriesService } from '../../services/subcategories.service';
import Swal from 'sweetalert2';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-product',
  standalone: true,
  imports: [CardProductComponent, RouterLink, RouterLinkActive, CommonModule],
  templateUrl: './product.component.html',
  styleUrl: './product.component.css',
})
export class ProductComponent
  implements OnInit, AfterViewInit, AfterViewChecked
{
  products: any;
  subcategory: any;
  index: number = 12;
  check: boolean = true;
  total: number = 0;

  optionPrice: any[] = [
    [0, 350000],
    [350000, 750000],
    [750000, 9999999],
  ];

  isClickFilterPrice: any[] = [];

  @ViewChildren('price') priceElements!: QueryList<ElementRef>;
  @ViewChildren('category') categoryElements!: QueryList<ElementRef>;

  activePrice: any = localStorage.getItem('activePrice');
  activeCategory: any = localStorage.getItem('activeCategory');

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private subCategoriesService: SubcategoriesService,
    private router: Router,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit(): void {
    this.getProduct();
    this.getSubCategory();
  }

  ngAfterViewInit(): void {}

  ngAfterViewChecked(): void {}

  viewMore() {
    this.index += 4;
    this.getProduct();
  }

  getProduct() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    this.route.queryParams
      .pipe(
        concatMap((queryParams: any) => {
          return this.productService.getProduct().pipe(
            concatMap((products: any) => {
              let data = products.filter(
                (product: any) => product.categories_id == queryParams.category
              );

              if (queryParams.min && queryParams.max) {
                data = data.filter(
                  (product: any) =>
                    product.price >= queryParams.min &&
                    product.price <= queryParams.max
                );
              }
              if (queryParams.subcategories) {
                data = data.filter(
                  (product: any) =>
                    product.subcategories_id == queryParams.subcategories
                );
              }

              this.total = data.length;
              const slicedData = data.slice(0, this.index);

              this.check = this.total > slicedData.length;

              return of(slicedData);
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.products = data;
        Swal.close();
      });
  }

  getSubCategory() {
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
      .subscribe((data: any) => {
        this.subcategory = data;
      });
  }

  filterPrice(event: any) {
    if (!event.target.value) {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { min: null, max: null },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          this.getProduct();
          this.index = 8;
        });
    } else {
      const [min, max] = event.target.value.replace(' ', '').split(',');

      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { min, max },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          this.getProduct();
        });
    }
  }

  filterSubCategory(event: any) {
    const subcategories = event.target.value;

    if (!subcategories) {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { subcategories: null },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          this.getProduct();
          this.index = 8;
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
