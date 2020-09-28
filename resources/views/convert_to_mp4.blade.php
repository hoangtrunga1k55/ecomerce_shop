<form action="convert" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="file" name="img">
    <button type="submit">Submit</button>
</form>
<video width="320" controls>
    <source src="{{asset("video/sample-avi-file1600620039.mp4")}}" type="video/mp4">
    Your browser does not support the video tag.
</video>