import { Component, OnInit } from '@angular/core';
import { UserService } from '../../services/user.service';
import {
  FormControl,
  FormGroup,
  FormsModule,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
})
export class LoginComponent implements OnInit {
  form: FormGroup = new FormGroup({
    email: new FormControl('', [Validators.required]),
    password: new FormControl('', [Validators.required]),
  });

  user: any = localStorage.getItem('user')
    ? JSON.parse(localStorage.getItem('user') || '')
    : '';

  ngOnInit(): void {}

  constructor(private userService: UserService) {}

  onSubmit() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    this.userService.login(this.form.value).subscribe(
      (data: any) => {
        Swal.fire({
          text: data.message,
          icon: 'success',
          allowOutsideClick: false,
        }).then(({ isConfirmed }) => {
          if (isConfirmed) {
            localStorage.setItem('user', JSON.stringify(data.user));
            location.href = '/';
          }
        });
      },
      (error) => {
        if (error.status === 401) {
          Swal.fire({
            text: error.error.message,
            icon: 'error',
            allowOutsideClick: false,
          });
        }
      }
    );
  }
}
