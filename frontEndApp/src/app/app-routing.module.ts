import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AddMovieComponent } from './add-movie/add-movie.component';
import { EditMovieComponent } from './edit-movie/edit-movie.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { SingleMovieComponent } from './single-movie/single-movie.component';
import { IsloggedGuard } from './guards/islogged.guard';
import { IsnotloggedGuard } from './guards/isnotlogged.guard';
import { Err404Component } from './err404/err404.component';
import { LogoutComponent } from './logout/logout.component';

const routes: Routes = [
  {path:'',component:HomeComponent,pathMatch:'full',canActivate:[IsnotloggedGuard]},
  {path:'login',component:LoginComponent,pathMatch:'full',canActivate:[IsloggedGuard]},
  {path:'register',component:RegisterComponent,pathMatch:'full',canActivate:[IsloggedGuard]},
  {path:'singleMovie/:id',component:SingleMovieComponent,pathMatch:'full',canActivate:[IsnotloggedGuard]},
  {path:'createMovie',component:AddMovieComponent,pathMatch:'full',canActivate:[IsnotloggedGuard]},
  {path:'editMovie/:id',component:EditMovieComponent,pathMatch:'full',canActivate:[IsnotloggedGuard]},
  {path:'logout',component:LogoutComponent,pathMatch:'full',canActivate:[IsnotloggedGuard]},
  {path:'**',component:Err404Component}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
