import { Component, OnInit } from '@angular/core';
import { DataServiceService } from '../data-service.service';
import { FormGroup, FormControl } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-add-movie',
  templateUrl: './add-movie.component.html',
  styleUrls: ['./add-movie.component.css']
})
export class AddMovieComponent implements OnInit {
AllCat:{id:number,name:string}[]=[];
AddMovieForm=new FormGroup({
  name: new FormControl(),
  description:new FormControl(),
  category_id:new FormControl()
});
  constructor(private dataService:DataServiceService, private _router: Router) {
    this.dataService.GetAllCategory().subscribe(data=>{
      this.AllCat=data.message;
    },(e)=>{console.log(e)}
    ,()=>{
    })
   }
  ngOnInit(): void {
  }
  get name(){
    return this.AddMovieForm.get('name')
  }
  get description(){
    return this.AddMovieForm.get('description')
  }
  get image(){
    return this.AddMovieForm.get('image')
  }
  file:any;
  onChange(event:any){
    this.file=event.target.files[0];}
  onAdd(data:any){
    const formData = new FormData();
    formData.append('name',this.AddMovieForm.value.name);
    formData.append('description',this.AddMovieForm.value.description);
    formData.append('category_id',this.AddMovieForm.value.category_id);
    formData.append('image', this.file,this.file.name);
    this.dataService.CreateNewMovie(formData).subscribe(data=>{
      console.log(data);
    },(e)=>{console.log(e)}
    ,()=>{this._router.navigateByUrl('/')})
  }

}
