function OnIResChange() {
  var itype = document.calcform.type.selectedIndex;
  var ilook = [
    1.72e-8, 2.82e-8, 1.43e-7, 4.6e-7, 2.44e-8, 1.1e-6, 6.99e-8, 1.59e-8,
  ];
  var res = '';
  if (itype > 0) {
    res = ilook[itype - 1];
    res = res.toExponential();
  }
  document.calcform.res.value = res;
}

function OnResChange() {
  document.calcform.type.selectedIndex = 0;
}

function OnCalc(e) {
  //var itype = document.calcform.type.selectedIndex;
  var issel = document.calcform.ssel.selectedIndex;
  var ilsel = document.calcform.lsel.selectedIndex;
  var iphase = document.calcform.phase.selectedIndex;

  n = document.calcform.s.value;
  len = document.calcform.l.value;
  v = document.calcform.v.value;
  i = document.calcform.i.value;

  //var ilook=[1.72e-8, 2.82e-8, 1.43e-7, 4.6e-7, 2.44e-8, 1.1e-6, 6.99e-8, 1.59e-8];
  //var res = ilook[itype];
  var res = document.calcform.res.value;
  var d;
  if (issel == 0) {
    if (n == '000000' || n == '6/0') n = -5;
    if (n == '00000' || n == '5/0') n = -4;
    if (n == '0000' || n == '4/0') n = -3;
    if (n == '000' || n == '3/0') n = -2;
    if (n == '00' || n == '2/0') n = -1;
    if (n > 40) {
      alert('AWG>40 is not valid');
      document.calcform.s.focus();
      document.calcform.s.select();
      return;
    }
    d = 0.127e-3 * Math.pow(92, (36 - n) / 39);
  } else if (issel == 1) {
    d = (25.4 * n) / 1000;
  } else {
    d = n / 1000;
  }
  if (ilsel == 0) len *= 0.3048;
  a = (Math.PI * d * d) / 4.0;
  r = (2 * res * len) / a;
  vd = i * r;
  if (iphase == 2) vd *= 1.732 / 2;
  vdp = (vd / v) * 100;
  document.calcform.vd.value = vd.toPrecision(6);
  document.calcform.vdp.value = vdp.toPrecision(6);
  document.calcform.r.value = r.toPrecision(6);
}
