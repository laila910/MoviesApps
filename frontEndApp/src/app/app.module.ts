import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { HomeComponent } from './home/home.component';
import { SingleMovieComponent } from './single-movie/single-movie.component';
import { AddMovieComponent } from './add-movie/add-movie.component';
import { EditMovieComponent } from './edit-movie/edit-movie.component';
import { HeaderComponent } from './shared/header/header.component';
import { FooterComponent } from './shared/footer/footer.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { FormBuilder, FormsModule, ReactiveFormsModule, FormGroup, FormGroupDirective } from '@angular/forms';
import { UserInterceptor } from './providers/user.interceptor';
import { Err404Component } from './err404/err404.component';
import { LogoutComponent } from './logout/logout.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    HomeComponent,
    SingleMovieComponent,
    AddMovieComponent,
    EditMovieComponent,
    HeaderComponent,
    FooterComponent,
    Err404Component,
    LogoutComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule,
  
  ],
  providers: [
    {provide:HTTP_INTERCEPTORS,useClass:UserInterceptor,multi:true}
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
