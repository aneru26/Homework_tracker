var c = document.getElementById("c");
var ctx = c.getContext("2d");
var cw = c.width = window.innerWidth;
var ch = c.height = window.innerHeight;
var howMany = 80;
var rad = (Math.PI / 180);
var kappa = 0.5522847498;
var a = 3 * Math.PI / 4;
var Rgrd = Math.sqrt(ch * ch + (cw / 2) * (cw / 2))
var grd = ctx.createRadialGradient(cw / 2, 0, 0, cw / 2, 0, Rgrd); // x0, y0, r0, x1, y1, r1
grd.addColorStop(0, "#badbf5");
grd.addColorStop(.35, "#53a5dd");
grd.addColorStop(.75, "#306eab");
grd.addColorStop(1, "#22417a");
ctx.fillStyle = grd;

ctx.strokeStyle = 'rgba(200,200,200,.3)';

function elementArray() {
  this.cx = Math.round(Math.random() * cw) + 1;
  this.cy = Math.round(Math.random() * ch) + 1;
  this.x = this.cx;
  this.y = this.cy;
  this.rw = randomIntFromInterval(5, 25);
  var deformation = randomIntFromInterval(75, 95) / 100;
  this.rh = ~~(this.rw * deformation);
  this.a = (Math.round(Math.random() * 360) + 1) * rad;
  this.driftFlag = Math.random() < 0.5 ? false : true;
  this.lift = randomIntFromInterval(2, 10) / 10;
  this.grd = Grd(this.cx, this.cy, this.rw);

}
var e1 = []; /*ellipses*/
for (var i = 0; i < howMany; i++) {
  e1[i] = new elementArray();
}

function ellipse(cx, cy, w, h, a, fill) {

  var ox = w * kappa; // desplasamiento horizontal (offset)
  var oy = h * kappa; // desplazamiento vertical (offset)
  var rw = Math.sqrt(oy * oy + w * w);
  var rh = Math.sqrt(ox * ox + h * h);

  var aw = Math.atan(oy / w);
  var ah = Math.atan(ox / h);

  var x0 = cx + w * Math.cos(a);
  var y0 = cy + w * Math.sin(a);
  var x1 = cx + h * Math.cos(Math.PI / 2 + a);
  var y1 = cy + h * Math.sin(Math.PI / 2 + a);
  var x2 = cx + w * Math.cos(Math.PI + a);
  var y2 = cy + w * Math.sin(Math.PI + a);
  var x3 = cx + h * Math.cos((3 * Math.PI / 2) + a);
  var y3 = cy + h * Math.sin((3 * Math.PI / 2) + a);

  var px1 = cx + rw * Math.cos(aw + a);
  var py1 = cy + rw * Math.sin(aw + a);
  var px2 = cx + rh * Math.cos((Math.PI / 2 - ah) + a);
  var py2 = cy + rh * Math.sin((Math.PI / 2 - ah) + a);
  var px3 = cx + rh * Math.cos((Math.PI / 2 + ah) + a);
  var py3 = cy + rh * Math.sin((Math.PI / 2 + ah) + a);
  var px4 = cx + rw * Math.cos((Math.PI - aw) + a);
  var py4 = cy + rw * Math.sin((Math.PI - aw) + a);
  var px5 = cx + rw * Math.cos((Math.PI + aw) + a);
  var py5 = cy + rw * Math.sin((Math.PI + aw) + a);
  var px6 = cx + rh * Math.cos((3 * Math.PI / 2 - ah) + a);
  var py6 = cy + rh * Math.sin((3 * Math.PI / 2 - ah) + a);
  var px7 = cx + rh * Math.cos((3 * Math.PI / 2 + ah) + a);
  var py7 = cy + rh * Math.sin((3 * Math.PI / 2 + ah) + a);
  var px8 = cx + rw * Math.cos((-aw) + a);
  var py8 = cy + rw * Math.sin((-aw) + a);

  ctx.save();

  ctx.fillStyle = fill;
  ctx.beginPath();
  ctx.moveTo(x0, y0)
  ctx.bezierCurveTo(px1, py1, px2, py2, x1, y1);
  ctx.bezierCurveTo(px3, py3, px4, py4, x2, y2);
  ctx.bezierCurveTo(px5, py5, px6, py6, x3, y3);
  ctx.bezierCurveTo(px7, py7, px8, py8, x0, y0);
  ctx.fill();
  ctx.stroke();
  ctx.restore();

}

function Grd(x, y, r) {
  grd = ctx.createRadialGradient(x, y - r / 20 * r, 0, x, y - r / 20 * r, r);
  grd.addColorStop(0, 'rgba(186,219,245,.9)');
  grd.addColorStop(1, 'rgba(186,219,245, 0.1)');
  return grd;
}

function randomIntFromInterval(mn, mx) {
  return Math.floor(Math.random() * (mx - mn + 1) + mn);
}

function Draw() {

    ctx.fillRect(0, 0, cw, ch);
    for (var j = 0; j < e1.length; j++) {
      // rotation 
      e1[j].a += .03;

      // lift
      if (e1[j].cy < -1 * e1[j].rw) {
        e1[j].cy = ch + e1[j].rw;
      } else {
        e1[j].cy -= e1[j].lift;
      }

      // drift
      if (e1[j].cx <= e1[j].x - 10) {
        e1[j].driftFlag = true;
      } else if (e1[j].cx >= e1[j].x + 10) {
        e1[j].driftFlag = false;
      }
      if (e1[j].driftFlag) {
        e1[j].cx += .15;
      } else {
        e1[j].cx -= .15;
      }

      // grd
      e1[j].grd = Grd(e1[j].cx, e1[j].cy, e1[j].rw);

      ellipse(e1[j].cx, e1[j].cy, e1[j].rw, e1[j].rh, e1[j].a, e1[j].grd);

    }
    requestId = window.requestAnimationFrame(Draw);
  }
  //Draw()
requestId = window.requestAnimationFrame(Draw);