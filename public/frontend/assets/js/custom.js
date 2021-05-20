// function removeCartData(rowId){
//     $.ajax({
//         type : 'post',
//         data : {rowId:rowId,_token: "{{ csrf_token() }}"},
//         url : "{!!route('remove_from_cart')!!}",
//         success : function(data){
//             if(data){
//                 console.log(data);
//             }else{
//                 console.log('error');
//             }
//         }
//     });
// }