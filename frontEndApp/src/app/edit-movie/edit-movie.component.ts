import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { DataServiceService } from '../data-service.service';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-edit-movie',
  templateUrl: './edit-movie.component.html',
  styleUrls: ['./edit-movie.component.css']
})
export class EditMovieComponent implements OnInit {
  AllCat:{id:number,name:string}[]=[];
  prev:any={
    name:"",
    description:"",
    image:"",
    category:""
  };
  id = this.route.snapshot.params['id'];
  constructor(private dataService:DataServiceService, private _router: Router,private route:ActivatedRoute,private http:HttpClient) {}
  ngOnInit(): void {
    this.dataService.showOneMovie(this.id).subscribe(data=>{
      this.prev=data.message;
    })
    this.dataService.GetAllCategory().subscribe(data=>{
      this.AllCat=data.message;
    },(e)=>{console.log(e)}
    ,()=>{});
  }
  get name(){
    return this.prev.get('name');
  }
  get description(){
    return this.prev.get('description')
  }
  get image(){
    return this.prev.get('image')
  }
  file!: File;
  onChange(event:any){
    this.file=event.target.files[0]
  }
      onAdd(data:any){
        var formData = new FormData();
        if(this.file){
          formData.append('image', this.file,this.file.name); 
        }else{
          formData.append('image', this.prev.image); 
        }
        formData.append('name',this.prev.name);
        formData.append('description',this.prev.description);
        formData.append('category_id',this.prev.category_id);
        formData.append('_method','put');

        this.dataService.EditMovie(formData,this.id).subscribe(data=>{
          console.log(data);
        },(e)=>{console.log(e)}
        ,()=>{this._router.navigateByUrl('/')})
      }
}
