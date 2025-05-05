import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class FavoriteService {
  private apiurl = environment.apiUrl;

  favoriteUpdated = new EventEmitter<void>();

  constructor(private http: HttpClient) {}

  getFavoriteUser(id: any) {
    return this.http.get(`${this.apiurl}/api/favorite/user/${id}`);
  }

  createFavorite(data: any) {
    return this.http.post(`${this.apiurl}/api/favorite`, data);
  }

  destroyFavorite(id: any) {
    return this.http.delete(`${this.apiurl}/api/favorite/${id}`);
  }
}
