import { inject } from '@angular/core';
import { CanActivateFn } from '@angular/router';
import Swal from 'sweetalert2';
import { UserService } from '../services/user.service';
import { lastValueFrom } from 'rxjs';

export const authGuard: CanActivateFn = async (route, state) => {
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
      Swal.close();
      return true;
    } else {
      location.href = '/';
      return false;
    }
  } catch (error) {
    location.href = '/';
    return false;
  }
};
