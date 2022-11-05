import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder,FormControl } from '@angular/forms';
import { Router } from '@angular/router';
import { DataServiceService } from '../data-service.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginForm = new FormGroup({
    email: new FormControl(),
    password: new FormControl()
  })
  get email() {
    return this.loginForm.get('email')
  }
  get password() {
    return this.loginForm.get('password')
  }
  constructor(public dataService: DataServiceService, private _router: Router) {
    if(!localStorage.getItem(`RegToken`) && !localStorage.getItem(`appToken`)){
      this._router.navigateByUrl(`/register`);
    }
   }

  ngOnInit(): void {}
  msg='';
  onLogin(data: any) {
    if (data.valid) {
    console.log(this.loginForm.value)
    this.dataService.loginUser(this.loginForm.value).subscribe(
      data => {
        console.log(data.authorisation.token)
        localStorage.setItem(`appToken`, `Bearer ${data.authorisation.token}`);
      },
      (e) => {console.log(e) },
      () => {
        this.msg='successfully registered';
        this.loginForm.reset();
        this.dataService.navMenu = this.dataService.myLoggedRoutes
        this._router.navigateByUrl('/')
      }
    )

    }
  }
 
}
