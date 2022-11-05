import { Component, OnInit } from '@angular/core';
import { DataServiceService } from '../data-service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  categories: any;
 AllMovies:any;
  constructor(public dataService:DataServiceService, public router:Router) { }
  allMovies(){
    this.dataService.getAllMovies().subscribe(data=>{
      this.AllMovies=data.message;
    },
    (e)=>{console.log(e)},
    ()=>{
    })
  }
  categoryHead='';
  homePopulateData(data:any){
    this.dataService.ShowOneCategory(data).subscribe(data=>{
      this.categoryHead=data.message.name;
    },(e)=>{console.log(e)},
    ()=>{})
    this.dataService.ListMoviesByCat(data).subscribe(data=>{
      this.AllMovies=data.message;
    },
    (e)=>{console.log(e)},
    ()=>{
    })
  }
  ngOnInit(): void {
    this.dataService.GetAllCategory().subscribe(data => {
      this.categories=data.message;
     },
       (e) => { console.log(e) },
       () => {
       });
       this.dataService.getAllMovies().subscribe(data=>{
        this.AllMovies=data.message;
      });
  }
  msg='';
  deleted(id:number){
     this.dataService.DeleteOneMovie(id).subscribe(data=>{
      this.msg='success, Movie Deleted';
      this.ngOnInit();
     },
     (e)=>{console.log(e)},
     ()=>{
     })
  }
}
