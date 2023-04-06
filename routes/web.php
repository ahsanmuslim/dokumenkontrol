<?php

use Teckindo\DokumenKontrol\App\Router;
use Teckindo\DokumenKontrol\Middleware\AuthMiddleware;
use Teckindo\DokumenKontrol\Controller\ {
    AuthController, LoginController, HomeController, UserController, JenisController,
    MenuController, RoleController, DivisiController, DocumentController,
    PostDocumentController,
    ShareDocumentController
};

//Router untuk Home
Router::add('GET', '/', LoginController::class, 'index');
Router::add('GET', '/home', HomeController::class, 'index', [AuthMiddleware::class]);

//Router untuk user
Router::add('GET', '/user', UserController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/user/add', UserController::class, 'add', [AuthMiddleware::class]);
Router::add('POST', '/user', UserController::class, 'save', [AuthMiddleware::class]);
Router::add('PUT', '/user/ttd', UserController::class, 'savettd', [AuthMiddleware::class]);
Router::add('GET', '/user/edit/([0-9a-zA-z\+_\-]*)', UserController::class, 'edit', [AuthMiddleware::class]);
Router::add('PUT', '/user', UserController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/user', UserController::class, 'delete', [AuthMiddleware::class]);

//Router untuk menu
Router::add('GET', '/controller', MenuController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/controller/add', MenuController::class, 'add', [AuthMiddleware::class]);
Router::add('POST', '/controller', MenuController::class, 'save', [AuthMiddleware::class]);
Router::add('GET', '/controller/edit/([0-9a-zA-z\+_\-]*)', MenuController::class, 'edit', [AuthMiddleware::class]);
Router::add('PUT', '/controller', MenuController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/controller', MenuController::class, 'delete', [AuthMiddleware::class]);

//Router untuk Role
Router::add('GET', '/role', RoleController::class, 'index', [AuthMiddleware::class]);
Router::add('POST', '/role/getEdit', RoleController::class, 'getEdit', [AuthMiddleware::class]);
Router::add('POST', '/role', RoleController::class, 'save', [AuthMiddleware::class]);
Router::add('PUT', '/role', RoleController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/role', RoleController::class, 'delete', [AuthMiddleware::class]);
Router::add('GET', '/role/akses/([0-9a-zA-z\+_\-]*)', RoleController::class, 'akses', [AuthMiddleware::class]);
Router::add('PUT', '/role/akses', RoleController::class, 'updateAkses', [AuthMiddleware::class]);

//Router untuk Dokument
Router::add('GET', '/sharedocument', ShareDocumentController::class, 'index', [AuthMiddleware::class]);

//Router untuk Dokument
Router::add('GET', '/document', DocumentController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/document/jenis/([0-9a-zA-z\+_\-]*)', DocumentController::class, 'jenis', [AuthMiddleware::class]);
Router::add('GET', '/document/add', DocumentController::class, 'add', [AuthMiddleware::class]);
Router::add('POST', '/document', DocumentController::class, 'save', [AuthMiddleware::class]);
Router::add('PUT', '/document/share', DocumentController::class, 'saveshare', [AuthMiddleware::class]);
Router::add('GET', '/document/sharewa/([0-9a-zA-z\+_\-/]*)', DocumentController::class, 'sharewa', [AuthMiddleware::class]);
Router::add('POST', '/document/sharewapost', DocumentController::class, 'sharewapost', [AuthMiddleware::class]);
Router::add('POST', '/document/getnomor', DocumentController::class, 'getNomor', [AuthMiddleware::class]);
Router::add('POST', '/document/getlogshare', DocumentController::class, 'getLogShare', [AuthMiddleware::class]);
Router::add('POST', '/document/detail', DocumentController::class, 'detail', [AuthMiddleware::class]);
Router::add('POST', '/document/share', DocumentController::class, 'share', [AuthMiddleware::class]);
Router::add('POST', '/document/sendemail', DocumentController::class, 'sendemail', [AuthMiddleware::class]);
Router::add('GET', '/document/edit/([0-9a-zA-z\+_\-/]*)', DocumentController::class, 'edit', [AuthMiddleware::class]);
Router::add('GET', '/document/viewer/([0-9a-zA-z\+_\-/]*)', DocumentController::class, 'viewer', [AuthMiddleware::class]);
Router::add('PUT', '/document', DocumentController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/document', DocumentController::class, 'delete', [AuthMiddleware::class]);

//Router untuk Post Dokument
Router::add('GET', '/postdocument', PostDocumentController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/postdocument/add', PostDocumentController::class, 'add', [AuthMiddleware::class]);
Router::add('POST', '/postdocument', PostDocumentController::class, 'save', [AuthMiddleware::class]);
Router::add('GET', '/postdocument/edit/([0-9a-zA-z\+_\-/]*)', PostDocumentController::class, 'edit', [AuthMiddleware::class]);
Router::add('GET', '/postdocument/detail/([0-9a-zA-z\+_\-/]*)', PostDocumentController::class, 'detail');
Router::add('GET', '/postdocument/archive/([0-9a-zA-z\+_\-/]*)', PostDocumentController::class, 'archive', [AuthMiddleware::class]);
Router::add('POST', '/postdocument/getnomorsurat', PostDocumentController::class, 'getNomorSurat', [AuthMiddleware::class]);
Router::add('PUT', '/postdocument', PostDocumentController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/postdocument', PostDocumentController::class, 'delete', [AuthMiddleware::class]);

//Router untuk Jenis Surat
Router::add('GET', '/jenis', JenisController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/jenis/add', JenisController::class, 'add', [AuthMiddleware::class]);
Router::add('POST', '/jenis', JenisController::class, 'save', [AuthMiddleware::class]);
Router::add('GET', '/jenis/edit/([0-9a-zA-z\+_\-]*)', JenisController::class, 'edit', [AuthMiddleware::class]);
Router::add('PUT', '/jenis', JenisController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/jenis', JenisController::class, 'delete', [AuthMiddleware::class]);

//Router untuk Divisi
Router::add('GET', '/divisi', DivisiController::class, 'index', [AuthMiddleware::class]);
Router::add('GET', '/divisi/add', DivisiController::class, 'add', [AuthMiddleware::class]);
Router::add('POST', '/divisi', DivisiController::class, 'save', [AuthMiddleware::class]);
Router::add('GET', '/divisi/edit/([0-9a-zA-z\+_\-]*)', DivisiController::class, 'edit', [AuthMiddleware::class]);
Router::add('PUT', '/divisi', DivisiController::class, 'update', [AuthMiddleware::class]);
Router::add('DELETE', '/divisi', DivisiController::class, 'delete', [AuthMiddleware::class]);

//Route untuk proses login
Router::add('POST', '/login', LoginController::class, 'login');
Router::add('GET', '/logout', LoginController::class, 'logout');
Router::add('GET', '/blocked', AuthController::class, 'blocked');
