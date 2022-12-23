// function for pagination

function pagination(totalpages,currentpage){
    if(totalpages>1){
        var pagelist="";
        currentpage=parseInt(currentpage);
        pagelist+=`<ul class="pagination justify-content-center mt-5">`;

        const preClass=currentpage==1?"disabled":"";
        pagelist+=`<li class="page-item ${preClass}"><a class="page-link" href="#" data-page="${currentpage-1}">Previous</a></li>`;

        for(let p=1;p<=totalpages;p++){
            const activeClass=currentpage==p?"active":"";
            pagelist+=`<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
        }

        const nextClass=currentpage==totalpages?"disabled":"";
        pagelist+=`<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page="${currentpage+1}">Next</a></li>`;
        pagelist+=`</ul>`;
        
    }
    $("#pagination").html(pagelist);
}


// function to get users from database

function getuserrow(user){
    var userRow="";
    if(user){
        userRow=`<tr>
        <td scope="row">${user.name}</td>
        <td>${user.email}</td>
        <td>${user.number}</td>
        <td>${user.address}</td>
        <td>${user.department}</td>
        <td>${user.designation}</td>
        <td><img src=uploads/${user.photo}></td>
        <td>

            <button type="button" class="btn btn-sm btn-success profile" title="profile" data-bs-toggle="modal" data-bs-target="#userViewModal" data-id=${user.id}>
            <i class="fa-regular fa-id-badge"></i>
            </button>
            <button type="button" class="btn btn-sm btn-primary edituser" title="edit" data-bs-toggle="modal" data-bs-target="#addemployee" data-id=${user.id}>
            <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button type="button" class="btn btn-sm btn-danger delete" title="delete" data-bs-toggle="modal" data-bs-target="#" data-id=${user.id}>
            <i class="fa-regular fa-trash-can"></i>
            </button>
            
        </td>
      </tr>`;
    }
    return userRow;
}


// get users function

function getusers(){

    var pageno=$("#currentpage").val();
    $.ajax({
        url:"/employeecrud1/ajax.php",
        type:"GET",
        dataType:"json",
        data:{page:pageno,action:'getallusers'},
        beforeSend:function(){
            console.log("wait...data is loading");
        },
        success:function(rows){
            console.log(rows);
            if(rows.players){
                var userslist="";
                $.each(rows.players,function(index,user){
                    userslist+=getuserrow(user); 
                });
                $("#usertable tbody").html(userslist);
                let totaluser=rows.count;
                let totalpages=Math.ceil(parseInt(totaluser)/4);
                const currentpage=$('#currentpage').val();
                pagination(totalpages,currentpage);
            }
        },
        error:function(request,error){
            console.log(arguments);
            console.log("Error"+ error);
        },
    });
}


// loading document

$(document).ready(function(){
    
    // adding users
    $(document).on("submit","#addform",function(e){
        e.preventDefault();

    
    // AJAX

    $.ajax({
        url:"/employeecrud1/ajax.php",
        type:"POST",
        dataType:"json",
        data: new FormData(this),
        processData:false,
        contentType:false,
        beforeSend:function(){
            console.log("wait...data is loading");
        },
        success:function(response){
            console.log(response);
            if(response){
                $("#addemployee").modal("hide");
                $("#addform")[0].reset();
                getusers();
            }
        },
        error:function(request,error){
            // console.log(arguments);
            // console.log("Error"+ error);

            console.log("oops something went wrong!")
        },
    });
});


// onclick event for pagination
$(document).on("click", "ul.pagination li a", function(event){
    event.preventDefault();

    const pagenum=$(this).data(page);
    $("#currentpage").val();
    getusers();
    $(this).parent().siblings().removeClass("active");
    $(this).parent().addClass("avtive");
    })


// onclick event for editing
$(document).on("click","a.edituser",function(){
    var uid=$(this).data("id");
    alert(uid);
        $.ajax({
        url:"/employeecrud1/ajax.php",
        type:"GET",
        dataType:"json",
        data:{id:uid,action:'editusersdata'},
        beforeSend:function(){
            console.log("wait...data is loading");
        },
        success:function(rows){
            console.log(rows);
            if(rows){
                $("#username").val(rows.name);
                $("#email").val(rows.email);
                $("#number").val(rows.number);
                $("#address").val(rows.address);
                $("#department").val(rows.department);
                $("#designation").val(rows.designation);
                $("#userid").val(rows.id);
            }
        },
        error:function(request,error){
            console.log(arguments);
            console.log("Error"+ error);
        },
    });
})


// onclick event for adding user btn
$("#adduserbtn").on("click",function(){
    $("#addform")[0].reset();
    $("#userid").val("");
})


// onlick event for deleting
$(document).on("click","a.deleteuser",function(e){
    e.preventDefault();
    var uid=$(this).data("id");
    if(confirm("Are you sure you want to delete?")){
        $.ajax({
            url:"/employeecrud1/ajax.php",
            type:"GET",
            dataType:"json",
            data:{id:uid,action:'deleteuser'},
            beforeSend:function(){
                console.log("waiting");
            },
            success:function(res){
                if(res.delete==1){
                    $("#displaymessage").html("User deleted successfully").fadeIN().delay(2500).fadeOut();
                    getusers();
                    console.log("done");
                }
            },
            error:function(){
                console.log("oops something went wrong!");
            },
        })
    }
})




// calling function
getusers();

});