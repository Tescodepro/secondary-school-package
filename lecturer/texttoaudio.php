<form method="post">
<textarea id="txt" name="txt" cols="30" rows="10"></textarea>
<input name="submit"  type="submit" value="Convert to Speech" />

</form>
<?php
if(isset($_POST['txt'])){
  $txt=$_POST['txt'];
  echo $txt;
  $txt=htmlspecialchars($txt);
  $txt=rawurlencode($txt);
  $audio=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
  echo $audio;
  $speech="<audio hidden controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($audio)."'</audio>";
  echo $speech;
}

// https://translate.google.com/?sl=en&tl=ar&text=My%20name%20is%20MUTULAHI%20Tesleem%20Olamilekan.%20I%20am%20an%20innovative%20software%20engineer%20with%20problem-solving%20skills%20who%20is%20passionate%20about%20improving%20efficiencies%2C%20designing%2C%20and%20producing%20valuable%20solutions%E2%80%94making%20use%20of%20industry%20languages%20and%20frameworks%20in%20the%20creation%20of%20applications%20to%20create%20market%20mechanisms.%20I%20have%20a%20good%20technical%20background%20in%20PHP%2C%20Laravel%2C%20and%20JavaScript.&op=translate
?>


