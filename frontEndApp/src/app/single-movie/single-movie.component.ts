import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { DataServiceService } from '../data-service.service';

@Component({
  selector: 'app-single-movie',
  templateUrl: './single-movie.component.html',
  styleUrls: ['./single-movie.component.css']
})
export class SingleMovieComponent implements OnInit {
  constructor(private dataService:DataServiceService,private _route:ActivatedRoute) { }
  id = this._route.snapshot.params['id'];
  userData: any = {}
  ngOnInit(): void {
    console.log(this.id);
    this.dataService.showOneMovie(this.id).subscribe(data=>{
         console.log(data.message);
         this.userData=data.message;
    })

  }

}
