import { inject } from '@angular/core';
import { CanActivateFn } from '@angular/router';
import { UserService } from '../services/user.service';
import { tap } from 'rxjs';
import Swal from 'sweetalert2';

export const guestGuard: CanActivateFn = async (route, state) => {
  Swal.fire({
    didOpen: () => {
      Swal.showLoading();
    },
    allowOutsideClick: false,
  });

  const userService = inject(UserService);

  const token = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : null;

  try {
    const check = await userService.decoded(token).toPromise();

    if (check) {
      location.href = '/profile';
      return false;
    } else {
      Swal.close();

      return true;
    }
  } catch (error) {
    Swal.close();
    return true;
  }
};
