import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class SubcategoriesService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  getSubCategories() {
    return this.http.get(this.apiUrl + '/api/danhmuccon');
  }
}
