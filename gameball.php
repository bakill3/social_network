<?php include 'header.php'; ?>
    <script src="TemplateData/UnityProgress.js"></script>
  <div class="template text-center">
    <div class="template-wrap clear">
      <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="600px" width="960px"></canvas>
      <br>
      <div class="logo"></div>
      <div class="fullscreen"><img src="TemplateData/fullscreen.png" width="38" height="38" alt="Fullscreen" title="Fullscreen" onclick="SetFullscreen(1);" /></div>
      <div class="title">GameBall</div>
    </div>
    <script type='text/javascript'>
  var Module = {
    TOTAL_MEMORY: 268435456,
    errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
    compatibilitycheck: null,
    backgroundColor: "#222C36",
    splashStyle: "Light",
    dataUrl: "Release/WebGl.data",
    codeUrl: "Release/WebGl.js",
    asmUrl: "Release/WebGl.asm.js",
    memUrl: "Release/WebGl.mem",
  };
</script>
<script src="Release/UnityLoader.js"></script>

  </div>
<?php include 'footer.php'; ?>