import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class FavoriteService {
  favoriteUpdated = new EventEmitter<void>();

  constructor(private http: HttpClient) {}

  getFavoriteUser(id: any) {
    return this.http.get(`http://localhost:8000/api/favorite/user/${id}`);
  }

  createFavorite(data: any) {
    return this.http.post(`http://localhost:8000/api/favorite`, data);
  }

  destroyFavorite(id: any) {
    return this.http.delete(`http://localhost:8000/api/favorite/${id}`);
  }
}
