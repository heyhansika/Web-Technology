// ---------------- STUDENTS ----------------

let students = [

{name:"Aman", roll:1, marks:95, branch:"CSE"},
{name:"Riya", roll:2, marks:88, branch:"ECE"},
{name:"Arjun", roll:3, marks:91, branch:"CSE"},
{name:"Sneha", roll:4, marks:76, branch:"ME"},
{name:"Rahul", roll:5, marks:85, branch:"IT"},
{name:"Priya", roll:6, marks:97, branch:"CSE"},
{name:"Karan", roll:7, marks:67, branch:"ECE"},
{name:"Neha", roll:8, marks:72, branch:"CSE"},
{name:"Vikas", roll:9, marks:89, branch:"ME"},
{name:"Anjali", roll:10, marks:93, branch:"CSE"}

];

let studentOutput = document.getElementById("studentOutput");

function displayStudentTable(data){

let table = `
<table>
<tr>
<th>Name</th>
<th>Roll</th>
<th>Marks</th>
<th>Branch</th>
</tr>
`;

data.forEach(s=>{
table+=`
<tr>
<td>${s.name}</td>
<td>${s.roll}</td>
<td>${s.marks}</td>
<td>${s.branch}</td>
</tr>
`;
});

table+="</table>";

studentOutput.innerHTML=table;

}


function studentOperation(){

let option = document.getElementById("studentOption").value;
let search = document.getElementById("searchName").value.toLowerCase();

let result = students;

if(search!=""){
result = students.filter(s=>s.name.toLowerCase().includes(search));
}

else if(option==="above90"){
result = students.filter(s=>s.marks>90);
}

else if(option==="cse"){
result = students.filter(s=>s.branch==="CSE");
}

else if(option==="topper"){
let topper = students.reduce((max,s)=> s.marks>max.marks ? s : max);
result=[topper];
}

displayStudentTable(result);

}



// ---------------- PRODUCTS ----------------

let products = [

{name:"Laptop", price:60000, category:"Electronics"},
{name:"Mobile", price:25000, category:"Electronics"},
{name:"TV", price:40000, category:"Electronics"},
{name:"Sofa", price:30000, category:"Furniture"},
{name:"Table", price:7000, category:"Furniture"},
{name:"Chair", price:3000, category:"Furniture"},
{name:"Rice", price:1000, category:"Groceries"},
{name:"Milk", price:50, category:"Groceries"},
{name:"Fan", price:2500, category:"Electronics"},
{name:"Bed", price:20000, category:"Furniture"}

];

let productOutput = document.getElementById("productOutput");

function displayProductTable(data){

let table = `
<table>
<tr>
<th>Product Name</th>
<th>Price</th>
<th>Category</th>
</tr>
`;

data.forEach(p=>{
table+=`
<tr>
<td>${p.name}</td>
<td>${p.price}</td>
<td>${p.category}</td>
</tr>
`;
});

table+="</table>";

productOutput.innerHTML=table;

}


function productOperation(){

let option = document.getElementById("productOption").value;

if(option==="total"){

let total = products.reduce((sum,p)=>sum+p.price,0);

productOutput.innerHTML="<h3 style='text-align:center'>Total Price: "+total+"</h3>";

return;

}

let result = products;

if(option==="electronics"){
result = products.filter(p=>p.category==="Electronics");
}

else if(option==="furniture"){
result = products.filter(p=>p.category==="Furniture");
}

else if(option==="groceries"){
result = products.filter(p=>p.category==="Groceries");
}

displayProductTable(result);

}