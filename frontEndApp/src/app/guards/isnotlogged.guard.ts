import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class IsnotloggedGuard implements CanActivate {
  constructor(private _router: Router){}
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot):boolean{
      if (!localStorage.getItem(`appToken`)) {
        this._router.navigateByUrl(`/login`)
        return false
      }
    return true;
  }
  
}
