import {
  Component,
  ElementRef,
  EventEmitter,
  OnInit,
  Output,
  QueryList,
  ViewChildren,
  viewChildren,
} from '@angular/core';
import {
  FormControl,
  FormGroup,
  FormsModule,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { PreviewService } from '../../services/preview.service';
import { concatMap, forkJoin } from 'rxjs';
import { ActivatedRoute } from '@angular/router';
import { UserService } from '../../services/user.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-preview',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './preview.component.html',
  styleUrl: './preview.component.css',
})
export class PreviewComponent implements OnInit {
  @Output()
  messageEvent = new EventEmitter<boolean>();

  @ViewChildren('rating')
  ratingElements!: QueryList<ElementRef>;

  form: FormGroup = new FormGroup({
    rating: new FormControl('', [Validators.required]),
    content: new FormControl('', [Validators.required]),
  });

  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';

  ngOnInit(): void {}

  constructor(
    private previewService: PreviewService,
    private route: ActivatedRoute,
    private userService: UserService
  ) {}

  closePreview() {
    this.messageEvent.emit(false);
  }

  clickRating(index: number) {
    this.form.patchValue({ rating: index + 1 });

    this.ratingElements.forEach((element: ElementRef, i: number) => {
      if (index >= i) {
        element.nativeElement.style.color = 'gold';
      } else {
        element.nativeElement.style.color = 'lightgray';
      }
    });
  }

  onSubmit() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    const { rating, content } = this.form.value;
    const id = this.route.snapshot.params['id'];

    this.userService
      .decoded(this.token)
      .pipe(
        concatMap((user: any) => {
          return this.previewService.getPreviewByProduct(id).pipe(
            concatMap((previews: any) => {
              const check = previews.find(
                (preview: any) => preview.id_user === user.id
              );

              if (check) {
                return this.previewService.updatePreview(
                  {
                    Rating: rating,
                    content,
                  },
                  check.MaDG
                );
              } else {
                return this.previewService.createPreview({
                  Rating: rating,
                  content,
                  id_product: id,
                  id_user: user.id,
                });
              }
            })
          );
        })
      )
      .subscribe(
        (data: any) => {
          Swal.fire({
            text: 'Đánh giá thành công',
            icon: 'success',
            allowOutsideClick: false,
          }).then(({ isConfirmed }) => {
            if (isConfirmed) location.reload();
          });
        },
        (error: any) => {
          location.href = '/login';
        }
      );
  }
}
