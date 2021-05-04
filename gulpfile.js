'use strict';
 
var gulp = require('gulp');
var electron = require('electron-connect').server.create();
var php = require('gulp-connect-php');

const host = "http://localhost";
const port = 80;
 

let mainWindow

gulp.task('serve', function () {
 
  // Start browser process
  electron.start();
 
  // Restart browser process
  gulp.watch('**/.php', electron.restart);
 
});

gulp.task('php', function(){
  php.server({base:'./public', port:8000, keepalive:true});
});

gulp.task('connect-sync', gulp.series('php'), function() {
	connect.server({}, function (){
	  browserSync({
	    proxy: `${host}:${port}`,
	    baseDir: "./public",
	    open: true,
	    notify: false
	  });
	});
	// console.log('tu je');
	gulp.watch('**/*.php').on('change', function () {
	  browserSync.reload();
	});

	createWindow();
});

function createWindow() {
  // Create a PHP Server
  // phpServer.createServer({
  //   port: port,
  //   hostname: host,
  //   base: `${__dirname}/public`,
  //   keepalive: false,
  //   open: false,
  //   bin: `/usr/bin/php`,
  //   router: __dirname + '/public/index.phpServer'
  // });
  
  // Create the browser window.
  const {
    width,
    height
  } = electron.screen.getPrimaryDisplay().workAreaSize
  mainWindow = new BrowserWindow({
    width: width,
    height: height,
    show: false,
    autoHideMenuBar: true
  })

  mainWindow.loadURL(serverUrl)

  mainWindow.webContents.once('dom-ready', function () {
    mainWindow.show()
    mainWindow.maximize();
    // mainWindow.webContents.openDevTools()
  });

  

  // Emitted when the window is closed.
  mainWindow.on('closed', function () {
    phpServer.close();
    mainWindow = null;
  })

	globalShortcut.register('f5', function() {
		console.log('f5 is pressed')
		mainWindow.reload()
	})
	globalShortcut.register('CommandOrControl+R', function() {
		console.log('CommandOrControl+R is pressed')
		mainWindow.reload()
	})
}

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.
//app.on('ready', createWindow) // <== this is extra so commented, enabling this can show 2 windows..

// Quit when all windows are closed.
// app.on('window-all-closed', function () {
//   // On OS X it is common for applications and their menu bar
//   // to stay active until the user quits explicitly with Cmd + Q
//   if (process.platform !== 'darwin') {
//     // PHP SERVER QUIT
//     phpServer.close();
//     app.quit();
//   }
// })

// app.on('activate', function () {
//   // On OS X it's common to re-create a window in the app when the
//   // dock icon is clicked and there are no other windows open.
//   if (mainWindow === null) {
//     createWindow()
//   }
// })

gulp.task('default', gulp.parallel('connect-sync', 'serve'), function() {

})