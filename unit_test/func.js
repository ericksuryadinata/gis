let data = [
	{
		"name":"senin",
		"data":[1,2,3]
	},
	{
		"name":"selasa",
		"data":[0,1,1]
	},
	{
		"name":"rabu",
		"data":[2,2,1]
	}
];
let result = [{"name": "total","data":[0,0,0]}];
data.forEach(function(value){
	value.data.forEach(function (value, index) {  
		result[0].data[index]+=value;
	})
});
console.log(result);
console.log(data);
