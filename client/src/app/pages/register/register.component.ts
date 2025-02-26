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
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css',
})
export class RegisterComponent implements OnInit {
  form: FormGroup = new FormGroup({
    name: new FormControl('', [Validators.required]),
    email: new FormControl('', [
      Validators.required,
      Validators.pattern(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/),
    ]),
    password: new FormControl('', [
      Validators.required,
      Validators.minLength(6),
    ]),
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

    const { name, password, email } = this.form.value;

    this.userService.register(this.form.value).subscribe(
      (data: any) => {
        Swal.fire({
          text: 'Đăng nhập thành công',
          allowOutsideClick: false,
          icon: 'success',
        }).then(({ isConfirmed }) => {
          if (isConfirmed) {
            location.href = 'login';
          }
        });
      },
      (error) => {
        this.form.controls['email'].setErrors({ emailExists: true });
        Swal.close();
      }
    );
  }
}
