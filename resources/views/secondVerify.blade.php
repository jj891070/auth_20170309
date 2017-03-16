@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Second Verify</h2></div>

                <div class="panel-body">
                    <form action="secondVerifyEnter" method="post" enctype="multipart/form-data" onsubmit="return prevent_no_data()">
                      {{csrf_field()}}
                         
                         <div class="form-group">
							   <label for="category">分類</label>
							   <select class="form-control" name="method" id="method" onclick="change1()" >
									  <option value="q" >QR-Code方法</option>
									  <option value="s"  selected="selected" >驗證碼方法</option>
							   </select>
						</div>
                         <div class="form-group" id="sk">
                               <label>請輸入驗證碼:</label>
                               <input id="input1" type="text" name="secretkey" placeholder=" 驗證碼">
                         </div>
                         <div class="form-group" style="display: none;" id="qc">
                               <label>上傳QR-code :</label>
                               <input id="file1" type="file" name="file1" >
                         </div>
                               <input type="submit" name="submit" value="確 認">
                               <input type="reset" value="清 除"></br>
                          @if(session('error')) 
                             <?php echo '<script>alert("對不起!驗證碼輸入錯誤")</script>' ?>
                          @endif 

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function prevent_no_data()
  {
    $data1=$('#input1').val();
    $file1=$('#file1').val();
    $met=$('#method').val();
    if($met=='s')
    {
        if($data1=="")
        {
           alert("你忘了輸入驗證碼!");
           $('#input_id').focus();
           console.log("test1");
           return false;     
        }
    }
    else
    {
    	if($file1=="")
        {
           alert("你忘了上傳檔案!");
           $('#input_id').focus();
           return false;     
        }
    } 
    return true;
  }

  function change1()
  {
  	
  	if($('#method').val()=='q')
    {
        $('#sk').hide();
        $('#qc').show();
    }
    else
    {
        $('#qc').hide();
        $('#sk').show();
    }
  }
  
  
</script>
@endsection
