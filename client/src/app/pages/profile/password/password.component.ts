import { Component, OnInit } from '@angular/core';
import {
  FormControl,
  FormGroup,
  FormsModule,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { UserService } from '../../../services/user.service';
import { concatMap } from 'rxjs';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-password',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './password.component.html',
  styleUrl: './password.component.css',
})
export class PasswordComponent implements OnInit {
  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';

  form: FormGroup = new FormGroup({
    old: new FormControl('', [Validators.required]),
    new: new FormControl('', [Validators.required, Validators.minLength(6)]),
    confirm: new FormControl('', [Validators.required]),
  });

  ngOnInit(): void {}

  constructor(private userService: UserService) {}

  onSubmit() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    if (this.form.value.new !== this.form.value.confirm) {
      this.form.controls['confirm'].setErrors({ match: true });
      Swal.close();
      return;
    }

    this.userService
      .decoded(this.token)
      .pipe(
        concatMap((user: any) => {
          return this.userService.changePassword({
            id: user.id,
            ...this.form.value,
          });
        })
      )
      .subscribe(
        (data: any) => {
          Swal.fire({
            text: 'Đổi mật khẩu thành công',
            icon: 'success',
            allowOutsideClick: false,
          }).then(({ isConfirmed }) => {
            if (isConfirmed) location.reload();
          });
        },
        (error: any) => {
          if (error.status === 401) {
            this.form.controls['old'].setErrors({ incorrect: true });
            Swal.close();
          }
        }
      );
  }
}
