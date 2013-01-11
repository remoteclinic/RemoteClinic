<?php
require_once "../pre-includes/all.php";
include "../includes/libraries.php";
page_permission("register_patient");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Patient</title>
<?php include "../theme/skin.php";?>
</head>
<body>
<?php include "../sections/forehead.php";?>
<div id="container">
<div id="page">
	<h1 class="patients patient-color">registering new patient</h1>
	<div class="patient-bottom-border"></div>
<div class="innertube">
<?php

if(isset($_REQUEST['submit'])){
	

	$gender=$_REQUEST['gender'];
	$age=$_REQUEST['age'];
	$serial=$_REQUEST['serial'];
	$name=friendly($_REQUEST['name']);
	$contact=friendly($_REQUEST['contact']);
	$email=friendly($_REQUEST['email']);
	$weight=friendly($_REQUEST['weight']);
	$profession=friendly($_REQUEST['profession']);
	$ref_contact=friendly($_REQUEST['ref_contact']);
	$address=friendly($_REQUEST['address']);


	$result=register_patient($gender,$age,$serial,$name,$contact,$email,$weight,$profession,$ref_contact,$address);

	if($result==false){
	echo"<div class=error><span class=errorIcon>Insufficient information. Please provide complete information...</span></div>";

	}else{

	write_log("$_SESSION[id]","registered the patient $name at $global_permission->guardian_short_name $_SESSION[branch]","patient","20");

	print "<script>";
		print " self.location='compose$extension?id=$result&success';"; 
	print "</script>";
	
	}
	


}
?>
<form method="post" action="" enctype="multipart/form-data">

	<ul id="form">
	<li class="title">Gender:</li><li><select name='gender'  id='gender' size='1' ><option value='Male'>Male</option><option value='Female'>Female</option><option value='Other'>Other</option></select></li>
	<li class="title">Age:</li><li><select name='age' id='age' size='1'>
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
			<option value="32">32</option>
			<option value="33">33</option>
			<option value="34">34</option>
			<option value="35">35</option>
			<option value="36">36</option>
			<option value="37">37</option>
			<option value="38">38</option>
			<option value="39">39</option>
			<option value="40">40</option>
			<option value="41">41</option>
			<option value="42">42</option>
			<option value="43">43</option>
			<option value="44">44</option>
			<option value="45">45</option>
			<option value="46">46</option>
			<option value="47">47</option>
			<option value="48">48</option>
			<option value="49">49</option>
			<option value="50">50</option>
			<option value="51">51</option>
			<option value="52">52</option>
			<option value="53">53</option>
			<option value="54">54</option>
			<option value="55">55</option>
			<option value="56">56</option>
			<option value="57">57</option>
			<option value="58">58</option>
			<option value="59">59</option>
			<option value="60">60</option>
			<option value="61">61</option>
			<option value="62">62</option>
			<option value="63">63</option>
			<option value="64">64</option>
			<option value="65">65</option>
			<option value="66">66</option>
			<option value="67">67</option>
			<option value="68">68</option>
			<option value="69">69</option>
			<option value="70">70</option>
			<option value="71">71</option>
			<option value="72">72</option>
			<option value="73">73</option>
			<option value="74">74</option>
			<option value="75">75</option>
			<option value="76">76</option>
			<option value="77">77</option>
			<option value="78">78</option>
			<option value="79">79</option>
			<option value="80">80</option>
			<option value="81">81</option>
			<option value="82">82</option>
			<option value="83">83</option>
			<option value="84">84</option>
			<option value="85">85</option>
			<option value="86">86</option>
			<option value="87">87</option>
			<option value="88">88</option>
			<option value="89">89</option>
			<option value="90">90</option>
			<option value="91">91</option>
			<option value="92">92</option>
			<option value="93">93</option>
			<option value="94">94</option>
			<option value="95">95</option>
			<option value="96">96</option>
			<option value="97">97</option>
			<option value="98">98</option>
			<option value="99">99</option>
			<option value="100">100</option>

          </select></li>
	<li class="title">Serial:</li><li><select name='serial' class="inputOne"  id='serial' size='1' >
				<option value="PA">PA</option>
				<option value="PB">PB</option>
				<option value="PC">PC</option>
				<option value="PD">PD</option>
				<option value="PE">PE</option>
				<option value="PF">PF</option>
				<option value="PG">PG</option>
				<option value="PH">PH</option>
				<option value="PI">PI</option>
				<option value="PJ">PJ</option>
				<option value="PK">PK</option>
				<option value="PL">PL</option>
				<option value="PM">PM</option>
				<option value="PN">PN</option>
				<option value="PO">PO</option>
				<option value="PP">PP</option>
				<option value="PQ">PQ</option>
				<option value="PR">PR</option>
				<option value="PS">PS</option>
				<option value="PT">PT</option>
				<option value="PU">PU</option>
				<option value="PV">PV</option>
				<option value="PW">PW</option>
				<option value="PX">PX</option>
				<option value="PY">PY</option>
				<option value="PZ">PZ</option>
          </select></li><li>&nbsp;</li>
	<li class="title">Full Name:</li><li><input name="name" type="text"  /></li>
	<li class="title">Contact Number:</li><li><input name="contact" type="text" /></li>


	<div id="page-clear" align="center"><input name="submit" class="formbutton patient" type="submit" value="proceed anyway"></div>

	<h3>complete information</h3>
	<li class="title">Email:</li><li><input name="email" type="text" /></li><li><strong>&nbsp;</strong></li>
	<li class="title">Weight:</li><li><input name="weight" type="text" /></li><li><strong>(kg)</strong></li>
	<li class="title">Profession:</li><li><input name="profession" type="text" /></li><li><strong>&nbsp;</strong></li>
	<li class="title">Reference Contact:</li><li><input name="ref_contact" type="text" /></li><li><strong>&nbsp;</strong></li>
	<li class="title">Address:</li><li><input name="address" type="text" /></li><li><strong>&nbsp;</strong></li>
    </ul>
	<div id="page-clear" align="center"><input name="submit" class="formbutton patient" type="submit" value="proceed"></div>
</form> 
</div>
</div> <!---- #page ---->
</div> <!---- #container ---->

<?php include "../sections/footer.php";?>
<?php include "../sections/footer-navigation.php";?>

</body>
</html>