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
import { EmailService } from '../../services/email.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css',
})
export class RegisterComponent implements OnInit {
  form: FormGroup = new FormGroup({
    email: new FormControl('', [
      Validators.required,
      Validators.pattern(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/),
    ]),
  });

  ngOnInit(): void {}

  constructor(
    private userService: UserService,
    private emailService: EmailService
  ) {}

  onSubmit() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    const { email } = this.form.value;

    this.userService.register({ email }).subscribe(
      (data: any) => {
        Swal.fire({
          text: data.message,
          icon: 'success',
          allowOutsideClick: false,
        }).then(({ isConfirmed }) => {
          if (isConfirmed) location.href = 'login';
        });
      },
      (error) => {
        this.form.controls['email'].setErrors({ emailExists: true });
        Swal.close();
      }
    );

    // this.userService.register(this.form.value).subscribe(
    //   (data: any) => {
    //     Swal.fire({
    //       text: 'Đăng nhập thành công',
    //       allowOutsideClick: false,
    //       icon: 'success',
    //     }).then(({ isConfirmed }) => {
    //       if (isConfirmed) {
    //         location.href = 'login';
    //       }
    //     });
    //   },
    //   (error) => {
    //     this.form.controls['email'].setErrors({ emailExists: true });
    //     Swal.close();
    //   }
    // );
  }
}
