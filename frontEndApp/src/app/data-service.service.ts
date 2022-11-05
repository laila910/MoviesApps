import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class DataServiceService {
  constructor(private http: HttpClient) { }

  public myRoutes=[
    {path:'login',key:"login",isAuth:false},
    {path:'register',key:"register",isAuth:false},
  ]
  public myLoggedRoutes=[
    {path:'',key:"Home",isAuth:true},
    {path:'singleMovie/:id',key:'singleMovie',isAuth:true},
    {path:'createMovie',key:'CreateMovie',isAuth:true},
    {path:'editMovie/:id',key:'EditMovie',isAuth:true},
    {path:'logout',key:'Logout',isAuth:true}
  ]

  public isLoggedIn = localStorage.getItem("appToken") ? true : false
  public navMenu = localStorage.getItem("appToken") ? this.myLoggedRoutes : this.myRoutes


  public commonUrl = "https://test-api.storexweb.com/api";

  registerUser(userData: any): Observable<any> {
    return this.http.post(`${this.commonUrl}/register`, userData)
  }
  loginUser(userData: any): Observable<any> {
    return this.http.post(`${this.commonUrl}/login`, userData)
  }
  // Crud system on movies
  getAllMovies():Observable<any>{
    return this.http.get(`${this.commonUrl}/movies`);
  }
  showOneMovie(id:number):Observable<any>{
    return this.http.get(`${this.commonUrl}/movies/${id}`);
  }
  CreateNewMovie(MovieData:any):Observable<any>{
    return this.http.post(`${this.commonUrl}/movies`,MovieData);
  }
  EditMovie(MovieData:any,id:number):Observable<any>{
    return this.http.post(`${this.commonUrl}/movies/${id}`,MovieData);
  }
  DeleteOneMovie(id:number):Observable<any>{
    return this.http.post(`${this.commonUrl}/movies/${id}`,{_method:'delete'});
  }
  // Crud system on categories
  GetAllCategory():Observable<any>{
    return this.http.get(`${this.commonUrl}/category`);
  }
  ListMoviesByCat(id:number):Observable<any>{
    return this.http.get(`${this.commonUrl}/moviesByCategory/${id}`);
  }
  ShowOneCategory(id:number):Observable<any>{
    return this.http.get(`${this.commonUrl}/category/${id}`);
  }
  CreateNewCategory(CatData:any):Observable<any>{
    return this.http.post(`${this.commonUrl}/category`,CatData);
  }
  UpdateNewCategory(CatData:any,id:number):Observable<any>{
    return this.http.post(`${this.commonUrl}/category/${id}`,CatData);
  }
  DeleteNewCategory(id:number):Observable<any>{
    return this.http.post(`${this.commonUrl}/${id}`,{_method:'delete'});
  }


}
