<h1>Parameter template</h1>
<p>If URL contains <b>/app-pattern/parameter</b>, you are redirect to this template.</p>
<p>Every URL parameter (except the first) is folder in <b>app/app-name/template</b>.</p>
<p>For example, if URL is <b>www.example.com/app-name/parameter1/parameter2/parameter3?var=val</b><br>the path to template will be <b>app/app-name/template/parameter1/parameter2/parameter3/Parameter3Template.php</b>
<br>URL variable <b>"var"</b> will passed to AppNameController.php</p>