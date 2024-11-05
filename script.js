const today = new Date();

const formatdate = today.toISOString().split('T')[0];
const date_value = document.getElementById('date');
date_value.value = formatdate;
date_value.setAttribute('min',formatdate);


// const myform = document.getElementById('myform');
// const verification = document.getElementById('verification');
//  const container = document.getElementById('container');
// myform.addEventListener('submit', function(){
//     verification.style.display = 'block';
//     container.style.display = 'none';
   
// }) 