<?php 
include 'inc/header.php';
?>

<div class="container mt-5">
        <div class="row justify-content-md-center">
                <div class="col-md-8">
                        <div class="text-center center-block">                
                                <h2>Directory of Code Factory students</h2>
                                <label>Search for course number: </label>
                                <form class="form-inline d-flex justify-content-center">
                                        <input name="searchInput" class="form-control" placeholder="e.g. FSWD10" #searchInput="ngModel" [(ngModel)]="searchText">
                                        <button class="btn btn-outline-secondary" (click)="searchText=''">reset</button>
                                </form>
                        </div>
                        <table class="table table-sm table-light mt-3 students-table">
                                <thead class="thead-dark students-thead">
                                        <th>Name</th>
                                        <th>eMail</th>
                                        <th>Course</th>
                                </thead>
                                <ng-container *ngFor="let customer of customerArray">
                                        <tr class="" *ngIf="filterCondition(customer)">
                                                <td>{{customer.first_name}} {{customer.last_name}}</td>
                                                <td>{{customer.email}}</td>
                                                <td>{{customer.course}}</td>
                                        </tr>
                                </ng-container>
                        </table>
                </div>
        </div>
</div>

<?php 
include 'inc/footer.php';
?>