import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DataServiceService } from '../data-service.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  userData: any = {}
  constructor(private dataService: DataServiceService, private _router: Router) { }
  ngOnInit(): void {
    if(localStorage.getItem(`RegToken`) && !localStorage.getItem(`appToken`)){
      this._router.navigateByUrl(`/login`);
    }
  }
  msg='';
   onRegister(data:any) {
    if (data.valid) {
      this.userData=data.value;
      this.dataService.registerUser(this.userData).subscribe(
        data => {
          if(data.status=='success'){
            this.msg='success In registeration';
          localStorage.setItem(`RegToken`, `Bearer ${data.authorisation.token}`);
          }
          },
        (e) => {console.log(e) },
        () => {
          if(localStorage.getItem(`RegToken`)){
            this._router.navigateByUrl('/login');
          } 
        }
      )

    }
  }
}
