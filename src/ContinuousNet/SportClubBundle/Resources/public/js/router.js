
/**
 * Config for the app router
 */
app.config(['$stateProvider',
function ($stateProvider) {

    $stateProvider.state('auth', {
        url: '/auth',
        template: '<div ui-view class="fade-in-right-big smooth"></div>',
        title: 'sidebar.nav.auth.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.auth.MAIN'
        }
    }).state('auth.login', {
        url: '/login',
        templateUrl: '/bundles/sportclub/js/components/Auth/login.html',
        title: 'content.list.LOGIN',
        ncyBreadcrumb: {
            label: 'content.list.LOGIN'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('LoginCtrl', 'LoginService')
    }).state('auth.register', {
        url: '/register',
        templateUrl: '/bundles/sportclub/js/components/Auth/register.html',
        title: 'content.list.REGISTER',
        ncyBreadcrumb: {
            label: 'content.list.REGISTER'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('sweet-alert', 'oitozero.ngSweetAlert', 'RegisterCtrl', 'RegisterService')
    }).state('auth.resetpassword', {
        url: '/reset-password',
        templateUrl: '/bundles/sportclub/js/components/Auth/reset_password.html',
        title: 'content.list.RESETPAWSSWORD',
        ncyBreadcrumb: {
            label: 'content.list.RESETPAWSSWORD'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('ResetPasswordCtrl', 'ResetPasswordService')
    }).state('auth.emailconfirm', {
        url: '/email-confirm/:token/:language',
        templateUrl: '/bundles/sportclub/js/components/Auth/email_confirm.html',
        title: 'content.list.EMAILCONFIRM',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCONFIRM'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('EmailConfirmCtrl', 'RegisterService')
    }).state('auth.reset', {
        url: '/reset/:token/:language',
        templateUrl: '/bundles/sportclub/js/components/Auth/reset.html',
        title: 'content.list.RESET',
        ncyBreadcrumb: {
            label: 'content.list.RESET'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('ResetCtrl', 'ResetPasswordService')
    }).state('auth.lockscreen', {
        url: '/lock-screen',
        templateUrl: '/bundles/sportclub/js/components/Auth/lock_screen.html',
        title: 'content.list.LOCKSCREEN',
        ncyBreadcrumb: {
            label: 'content.list.LOCKSCREEN'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('LockScreenCtrl', 'LoginService')
    }).state('app.profile', {
        url: '/profile',
        templateUrl: '/bundles/sportclub/js/components/Auth/profile.html',
        title: 'topbar.user.PROFILE',
        ncyBreadcrumb: {
            label: 'topbar.user.PROFILE'
        },
        resolve: loadSequence('jquery-sparkline', 'ProfileCtrl', 'ProfileService')
    }).state('app.changepassword', {
        url: '/change-password',
        templateUrl: '/bundles/sportclub/js/components/Auth/change_password.html',
        title: 'topbar.user.CHANGEPASSWORD',
        ncyBreadcrumb: {
            label: 'topbar.user.CHANGEPASSWORD'
        },
        resolve: loadSequence('jquery-sparkline', 'ChangePasswordCtrl', 'ProfileService')
    }).state('app.dashboard', {
        url: '/dashboard',
        templateUrl: '/bundles/sportclub/js/components/Main/dashboard.html',
        title: 'content.list.DASHBOARD',
        ncyBreadcrumb: {
            label: 'content.list.DASHBOARD'
        },
        resolve: loadSequence('jquery-sparkline', 'DashboardCtrl', 'DashboardService')
    }).state('app.webradio', {
        url: '/web-radio',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.webradio.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.webradio.MAIN'
        }
    }).state('app.webradio.audios', {
        url: '/audios',
        templateUrl: '/bundles/sportclub/js/components/Audio/audios.html',
        title: 'content.list.AUDIOS',
        ncyBreadcrumb: {
            label: 'content.list.AUDIOS'
        },
        resolve: loadSequence('ngTable', 'AudiosCtrl', 'audioService', 'audioTypeService', 'priceService', 'sharingService', 'albumService', 'userService', 'audioCategoryService')
    }).state('app.webradio.audiosnew', {
        url: '/audios/new',
        templateUrl: '/bundles/sportclub/js/components/Audio/audio_form.html',
        title: 'content.list.NEWAUDIO',
        ncyBreadcrumb: {
            label: 'content.list.NEWAUDIO'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AudioFormCtrl', 'audioService', 'audioTypeService', 'priceService', 'sharingService', 'albumService', 'userService', 'audioCategoryService')
    }).state('app.webradio.audiosedit', {
        url: '/audios/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Audio/audio_form.html',
        title: 'content.list.EDITAUDIO',
        ncyBreadcrumb: {
            label: 'content.list.EDITAUDIO'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AudioFormCtrl', 'audioService', 'audioTypeService', 'priceService', 'sharingService', 'albumService', 'userService', 'audioCategoryService')
    }).state('app.webradio.audiosdetails', {
        url: '/audios/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Audio/audio.html',
        ncyBreadcrumb: {
            label: 'content.list.AUDIODETAILS'
        },
        resolve: loadSequence('AudioCtrl', 'audioService')
    }).state('app.webradio.audiosconvert', {
        url: '/audios/convert/:id',
        templateUrl: '/bundles/sportclub/js/components/Audio/audio_converter.html',
        ncyBreadcrumb: {
            label: 'content.list.CONVERTAUDIO'
        },
        resolve: loadSequence('AudioConverterCtrl', 'AudioConverterService', 'audioService')
    }).state('app.webradio.audiocategories', {
        url: '/audio-categories',
        templateUrl: '/bundles/sportclub/js/components/AudioCategory/audio_categories.html',
        title: 'content.list.AUDIOCATEGORIES',
        ncyBreadcrumb: {
            label: 'content.list.AUDIOCATEGORIES'
        },
        resolve: loadSequence('ngTable', 'AudioCategoriesCtrl', 'audioCategoryService', 'audioTypeService', 'userService')
    }).state('app.webradio.audiocategoriesnew', {
        url: '/audio-categories/new',
        templateUrl: '/bundles/sportclub/js/components/AudioCategory/audio_category_form.html',
        title: 'content.list.NEWAUDIOCATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.NEWAUDIOCATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AudioCategoryFormCtrl', 'audioCategoryService', 'audioTypeService', 'userService')
    }).state('app.webradio.audiocategoriesedit', {
        url: '/audio-categories/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/AudioCategory/audio_category_form.html',
        title: 'content.list.EDITAUDIOCATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.EDITAUDIOCATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AudioCategoryFormCtrl', 'audioCategoryService', 'audioTypeService', 'userService')
    }).state('app.webradio.audiocategoriesdetails', {
        url: '/audio-categories/details/:id',
        templateUrl: '/bundles/sportclub/js/components/AudioCategory/audio_category.html',
        ncyBreadcrumb: {
            label: 'content.list.AUDIOCATEGORYDETAILS'
        },
        resolve: loadSequence('AudioCategoryCtrl', 'audioCategoryService')
    }).state('app.webradio.audiotypes', {
        url: '/audio-types',
        templateUrl: '/bundles/sportclub/js/components/AudioType/audio_types.html',
        title: 'content.list.AUDIOTYPES',
        ncyBreadcrumb: {
            label: 'content.list.AUDIOTYPES'
        },
        resolve: loadSequence('ngTable', 'AudioTypesCtrl', 'audioTypeService', 'userService')
    }).state('app.webradio.audiotypesnew', {
        url: '/audio-types/new',
        templateUrl: '/bundles/sportclub/js/components/AudioType/audio_type_form.html',
        title: 'content.list.NEWAUDIOTYPE',
        ncyBreadcrumb: {
            label: 'content.list.NEWAUDIOTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AudioTypeFormCtrl', 'audioTypeService', 'userService')
    }).state('app.webradio.audiotypesedit', {
        url: '/audio-types/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/AudioType/audio_type_form.html',
        title: 'content.list.EDITAUDIOTYPE',
        ncyBreadcrumb: {
            label: 'content.list.EDITAUDIOTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AudioTypeFormCtrl', 'audioTypeService', 'userService')
    }).state('app.webradio.audiotypesdetails', {
        url: '/audio-types/details/:id',
        templateUrl: '/bundles/sportclub/js/components/AudioType/audio_type.html',
        ncyBreadcrumb: {
            label: 'content.list.AUDIOTYPEDETAILS'
        },
        resolve: loadSequence('AudioTypeCtrl', 'audioTypeService')
    }).state('app.webradio.albums', {
        url: '/albums',
        templateUrl: '/bundles/sportclub/js/components/Album/albums.html',
        title: 'content.list.ALBUMS',
        ncyBreadcrumb: {
            label: 'content.list.ALBUMS'
        },
        resolve: loadSequence('ngTable', 'AlbumsCtrl', 'albumService', 'userService')
    }).state('app.webradio.albumsnew', {
        url: '/albums/new',
        templateUrl: '/bundles/sportclub/js/components/Album/album_form.html',
        title: 'content.list.NEWALBUM',
        ncyBreadcrumb: {
            label: 'content.list.NEWALBUM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AlbumFormCtrl', 'albumService', 'userService')
    }).state('app.webradio.albumsedit', {
        url: '/albums/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Album/album_form.html',
        title: 'content.list.EDITALBUM',
        ncyBreadcrumb: {
            label: 'content.list.EDITALBUM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'AlbumFormCtrl', 'albumService', 'userService')
    }).state('app.webradio.albumsdetails', {
        url: '/albums/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Album/album.html',
        ncyBreadcrumb: {
            label: 'content.list.ALBUMDETAILS'
        },
        resolve: loadSequence('AlbumCtrl', 'albumService')
    }).state('app.adserving', {
        url: '/adserving',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.adserving.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.adserving.MAIN'
        }
    }).state('app.adserving.banners', {
        url: '/banners',
        templateUrl: '/bundles/sportclub/js/components/Banner/banners.html',
        title: 'content.list.BANNERS',
        ncyBreadcrumb: {
            label: 'content.list.BANNERS'
        },
        resolve: loadSequence('ngTable', 'BannersCtrl', 'bannerService', 'bannerTypeService', 'userService')
    }).state('app.adserving.bannersnew', {
        url: '/banners/new',
        templateUrl: '/bundles/sportclub/js/components/Banner/banner_form.html',
        title: 'content.list.NEWBANNER',
        ncyBreadcrumb: {
            label: 'content.list.NEWBANNER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'BannerFormCtrl', 'bannerService', 'bannerTypeService', 'userService')
    }).state('app.adserving.bannersedit', {
        url: '/banners/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Banner/banner_form.html',
        title: 'content.list.EDITBANNER',
        ncyBreadcrumb: {
            label: 'content.list.EDITBANNER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'BannerFormCtrl', 'bannerService', 'bannerTypeService', 'userService')
    }).state('app.adserving.bannersdetails', {
        url: '/banners/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Banner/banner.html',
        ncyBreadcrumb: {
            label: 'content.list.BANNERDETAILS'
        },
        resolve: loadSequence('BannerCtrl', 'bannerService')
    }).state('app.adserving.bannertypes', {
        url: '/banner-types',
        templateUrl: '/bundles/sportclub/js/components/BannerType/banner_types.html',
        title: 'content.list.BANNERTYPES',
        ncyBreadcrumb: {
            label: 'content.list.BANNERTYPES'
        },
        resolve: loadSequence('ngTable', 'BannerTypesCtrl', 'bannerTypeService', 'userService')
    }).state('app.adserving.bannertypesnew', {
        url: '/banner-types/new',
        templateUrl: '/bundles/sportclub/js/components/BannerType/banner_type_form.html',
        title: 'content.list.NEWBANNERTYPE',
        ncyBreadcrumb: {
            label: 'content.list.NEWBANNERTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'BannerTypeFormCtrl', 'bannerTypeService', 'userService')
    }).state('app.adserving.bannertypesedit', {
        url: '/banner-types/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/BannerType/banner_type_form.html',
        title: 'content.list.EDITBANNERTYPE',
        ncyBreadcrumb: {
            label: 'content.list.EDITBANNERTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'BannerTypeFormCtrl', 'bannerTypeService', 'userService')
    }).state('app.adserving.bannertypesdetails', {
        url: '/banner-types/details/:id',
        templateUrl: '/bundles/sportclub/js/components/BannerType/banner_type.html',
        ncyBreadcrumb: {
            label: 'content.list.BANNERTYPEDETAILS'
        },
        resolve: loadSequence('BannerTypeCtrl', 'bannerTypeService')
    }).state('app.adserving.clicks', {
        url: '/clicks',
        templateUrl: '/bundles/sportclub/js/components/Click/clicks.html',
        title: 'content.list.CLICKS',
        ncyBreadcrumb: {
            label: 'content.list.CLICKS'
        },
        resolve: loadSequence('ngTable', 'ClicksCtrl', 'clickService', 'visitService', 'bannerService', 'userService')
    }).state('app.adserving.clicksnew', {
        url: '/clicks/new',
        templateUrl: '/bundles/sportclub/js/components/Click/click_form.html',
        title: 'content.list.NEWCLICK',
        ncyBreadcrumb: {
            label: 'content.list.NEWCLICK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ClickFormCtrl', 'clickService', 'visitService', 'bannerService', 'userService')
    }).state('app.adserving.clicksedit', {
        url: '/clicks/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Click/click_form.html',
        title: 'content.list.EDITCLICK',
        ncyBreadcrumb: {
            label: 'content.list.EDITCLICK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ClickFormCtrl', 'clickService', 'visitService', 'bannerService', 'userService')
    }).state('app.adserving.clicksdetails', {
        url: '/clicks/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Click/click.html',
        ncyBreadcrumb: {
            label: 'content.list.CLICKDETAILS'
        },
        resolve: loadSequence('ClickCtrl', 'clickService')
    }).state('app.adserving.impressions', {
        url: '/impressions',
        templateUrl: '/bundles/sportclub/js/components/Impression/impressions.html',
        title: 'content.list.IMPRESSIONS',
        ncyBreadcrumb: {
            label: 'content.list.IMPRESSIONS'
        },
        resolve: loadSequence('ngTable', 'ImpressionsCtrl', 'impressionService', 'visitService', 'bannerService', 'userService')
    }).state('app.adserving.impressionsnew', {
        url: '/impressions/new',
        templateUrl: '/bundles/sportclub/js/components/Impression/impression_form.html',
        title: 'content.list.NEWIMPRESSION',
        ncyBreadcrumb: {
            label: 'content.list.NEWIMPRESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImpressionFormCtrl', 'impressionService', 'visitService', 'bannerService', 'userService')
    }).state('app.adserving.impressionsedit', {
        url: '/impressions/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Impression/impression_form.html',
        title: 'content.list.EDITIMPRESSION',
        ncyBreadcrumb: {
            label: 'content.list.EDITIMPRESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImpressionFormCtrl', 'impressionService', 'visitService', 'bannerService', 'userService')
    }).state('app.adserving.impressionsdetails', {
        url: '/impressions/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Impression/impression.html',
        ncyBreadcrumb: {
            label: 'content.list.IMPRESSIONDETAILS'
        },
        resolve: loadSequence('ImpressionCtrl', 'impressionService')
    }).state('app.settings', {
        url: '/settings',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.settings.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.settings.MAIN'
        }
    }).state('app.settings.languages', {
        url: '/languages',
        templateUrl: '/bundles/sportclub/js/components/Language/languages.html',
        title: 'content.list.LANGUAGES',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGES'
        },
        resolve: loadSequence('ngTable', 'LanguagesCtrl', 'languageService', 'userService')
    }).state('app.settings.languagesnew', {
        url: '/languages/new',
        templateUrl: '/bundles/sportclub/js/components/Language/language_form.html',
        title: 'content.list.NEWLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.settings.languagesedit', {
        url: '/languages/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Language/language_form.html',
        title: 'content.list.EDITLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.settings.languagesdetails', {
        url: '/languages/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Language/language.html',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGEDETAILS'
        },
        resolve: loadSequence('LanguageCtrl', 'languageService')
    }).state('app.settings.countries', {
        url: '/countries',
        templateUrl: '/bundles/sportclub/js/components/Country/countries.html',
        title: 'content.list.COUNTRIES',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRIES'
        },
        resolve: loadSequence('ngTable', 'CountriesCtrl', 'countryService', 'userService')
    }).state('app.settings.countriesnew', {
        url: '/countries/new',
        templateUrl: '/bundles/sportclub/js/components/Country/country_form.html',
        title: 'content.list.NEWCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.settings.countriesedit', {
        url: '/countries/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Country/country_form.html',
        title: 'content.list.EDITCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.settings.countriesdetails', {
        url: '/countries/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Country/country.html',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRYDETAILS'
        },
        resolve: loadSequence('CountryCtrl', 'countryService')
    }).state('app.settings.cities', {
        url: '/cities',
        templateUrl: '/bundles/sportclub/js/components/City/cities.html',
        title: 'content.list.CITIES',
        ncyBreadcrumb: {
            label: 'content.list.CITIES'
        },
        resolve: loadSequence('ngTable', 'CitiesCtrl', 'cityService', 'countryService', 'userService')
    }).state('app.settings.citiesnew', {
        url: '/cities/new',
        templateUrl: '/bundles/sportclub/js/components/City/city_form.html',
        title: 'content.list.NEWCITY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCITY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CityFormCtrl', 'cityService', 'countryService', 'userService')
    }).state('app.settings.citiesedit', {
        url: '/cities/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/City/city_form.html',
        title: 'content.list.EDITCITY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCITY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CityFormCtrl', 'cityService', 'countryService', 'userService')
    }).state('app.settings.citiesdetails', {
        url: '/cities/details/:id',
        templateUrl: '/bundles/sportclub/js/components/City/city.html',
        ncyBreadcrumb: {
            label: 'content.list.CITYDETAILS'
        },
        resolve: loadSequence('CityCtrl', 'cityService')
    }).state('app.settings.menus', {
        url: '/menus',
        templateUrl: '/bundles/sportclub/js/components/Menu/menus.html',
        title: 'content.list.MENUS',
        ncyBreadcrumb: {
            label: 'content.list.MENUS'
        },
        resolve: loadSequence('ngTable', 'MenusCtrl', 'menuService', 'userService')
    }).state('app.settings.menusnew', {
        url: '/menus/new',
        templateUrl: '/bundles/sportclub/js/components/Menu/menu_form.html',
        title: 'content.list.NEWMENU',
        ncyBreadcrumb: {
            label: 'content.list.NEWMENU'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MenuFormCtrl', 'menuService', 'userService')
    }).state('app.settings.menusedit', {
        url: '/menus/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Menu/menu_form.html',
        title: 'content.list.EDITMENU',
        ncyBreadcrumb: {
            label: 'content.list.EDITMENU'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MenuFormCtrl', 'menuService', 'userService')
    }).state('app.settings.menusdetails', {
        url: '/menus/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Menu/menu.html',
        ncyBreadcrumb: {
            label: 'content.list.MENUDETAILS'
        },
        resolve: loadSequence('MenuCtrl', 'menuService')
    }).state('app.settings.menulinks', {
        url: '/menu-links',
        templateUrl: '/bundles/sportclub/js/components/MenuLink/menu_links.html',
        title: 'content.list.MENULINKS',
        ncyBreadcrumb: {
            label: 'content.list.MENULINKS'
        },
        resolve: loadSequence('ngTable', 'MenuLinksCtrl', 'menuLinkService', 'menuService', 'userService')
    }).state('app.settings.menulinksnew', {
        url: '/menu-links/new',
        templateUrl: '/bundles/sportclub/js/components/MenuLink/menu_link_form.html',
        title: 'content.list.NEWMENULINK',
        ncyBreadcrumb: {
            label: 'content.list.NEWMENULINK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MenuLinkFormCtrl', 'menuLinkService', 'menuService', 'userService')
    }).state('app.settings.menulinksedit', {
        url: '/menu-links/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/MenuLink/menu_link_form.html',
        title: 'content.list.EDITMENULINK',
        ncyBreadcrumb: {
            label: 'content.list.EDITMENULINK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MenuLinkFormCtrl', 'menuLinkService', 'menuService', 'userService')
    }).state('app.settings.menulinksdetails', {
        url: '/menu-links/details/:id',
        templateUrl: '/bundles/sportclub/js/components/MenuLink/menu_link.html',
        ncyBreadcrumb: {
            label: 'content.list.MENULINKDETAILS'
        },
        resolve: loadSequence('MenuLinkCtrl', 'menuLinkService')
    }).state('app.activities', {
        url: '/activities',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.activities.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.activities.MAIN'
        }
    }).state('app.activities.comments', {
        url: '/comments',
        templateUrl: '/bundles/sportclub/js/components/Comment/comments.html',
        title: 'content.list.COMMENTS',
        ncyBreadcrumb: {
            label: 'content.list.COMMENTS'
        },
        resolve: loadSequence('ngTable', 'CommentsCtrl', 'commentService', 'cityService', 'userService')
    }).state('app.activities.commentsnew', {
        url: '/comments/new',
        templateUrl: '/bundles/sportclub/js/components/Comment/comment_form.html',
        title: 'content.list.NEWCOMMENT',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOMMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CommentFormCtrl', 'commentService', 'cityService', 'userService')
    }).state('app.activities.commentsedit', {
        url: '/comments/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Comment/comment_form.html',
        title: 'content.list.EDITCOMMENT',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOMMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CommentFormCtrl', 'commentService', 'cityService', 'userService')
    }).state('app.activities.commentsdetails', {
        url: '/comments/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Comment/comment.html',
        ncyBreadcrumb: {
            label: 'content.list.COMMENTDETAILS'
        },
        resolve: loadSequence('CommentCtrl', 'commentService')
    }).state('app.activities.likes', {
        url: '/likes',
        templateUrl: '/bundles/sportclub/js/components/Like/likes.html',
        title: 'content.list.LIKES',
        ncyBreadcrumb: {
            label: 'content.list.LIKES'
        },
        resolve: loadSequence('ngTable', 'LikesCtrl', 'likeService', 'userService')
    }).state('app.activities.likesnew', {
        url: '/likes/new',
        templateUrl: '/bundles/sportclub/js/components/Like/like_form.html',
        title: 'content.list.NEWLIKE',
        ncyBreadcrumb: {
            label: 'content.list.NEWLIKE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LikeFormCtrl', 'likeService', 'userService')
    }).state('app.activities.likesedit', {
        url: '/likes/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Like/like_form.html',
        title: 'content.list.EDITLIKE',
        ncyBreadcrumb: {
            label: 'content.list.EDITLIKE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LikeFormCtrl', 'likeService', 'userService')
    }).state('app.activities.likesdetails', {
        url: '/likes/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Like/like.html',
        ncyBreadcrumb: {
            label: 'content.list.LIKEDETAILS'
        },
        resolve: loadSequence('LikeCtrl', 'likeService')
    }).state('app.activities.ratings', {
        url: '/ratings',
        templateUrl: '/bundles/sportclub/js/components/Rating/ratings.html',
        title: 'content.list.RATINGS',
        ncyBreadcrumb: {
            label: 'content.list.RATINGS'
        },
        resolve: loadSequence('ngTable', 'RatingsCtrl', 'ratingService', 'userService')
    }).state('app.activities.ratingsnew', {
        url: '/ratings/new',
        templateUrl: '/bundles/sportclub/js/components/Rating/rating_form.html',
        title: 'content.list.NEWRATING',
        ncyBreadcrumb: {
            label: 'content.list.NEWRATING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'RatingFormCtrl', 'ratingService', 'userService')
    }).state('app.activities.ratingsedit', {
        url: '/ratings/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Rating/rating_form.html',
        title: 'content.list.EDITRATING',
        ncyBreadcrumb: {
            label: 'content.list.EDITRATING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'RatingFormCtrl', 'ratingService', 'userService')
    }).state('app.activities.ratingsdetails', {
        url: '/ratings/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Rating/rating.html',
        ncyBreadcrumb: {
            label: 'content.list.RATINGDETAILS'
        },
        resolve: loadSequence('RatingCtrl', 'ratingService')
    }).state('app.access', {
        url: '/access',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.access.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.access.MAIN'
        }
    }).state('app.access.notifications', {
        url: '/notifications',
        templateUrl: '/bundles/sportclub/js/components/Notification/notifications.html',
        title: 'content.list.NOTIFICATIONS',
        ncyBreadcrumb: {
            label: 'content.list.NOTIFICATIONS'
        },
        resolve: loadSequence('ngTable', 'NotificationsCtrl', 'notificationService', 'userService')
    }).state('app.access.notificationsnew', {
        url: '/notifications/new',
        templateUrl: '/bundles/sportclub/js/components/Notification/notification_form.html',
        title: 'content.list.NEWNOTIFICATION',
        ncyBreadcrumb: {
            label: 'content.list.NEWNOTIFICATION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NotificationFormCtrl', 'notificationService', 'userService')
    }).state('app.access.notificationsedit', {
        url: '/notifications/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Notification/notification_form.html',
        title: 'content.list.EDITNOTIFICATION',
        ncyBreadcrumb: {
            label: 'content.list.EDITNOTIFICATION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NotificationFormCtrl', 'notificationService', 'userService')
    }).state('app.access.notificationsdetails', {
        url: '/notifications/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Notification/notification.html',
        ncyBreadcrumb: {
            label: 'content.list.NOTIFICATIONDETAILS'
        },
        resolve: loadSequence('NotificationCtrl', 'notificationService')
    }).state('app.access.users', {
        url: '/users',
        templateUrl: '/bundles/sportclub/js/components/User/users.html',
        title: 'content.list.USERS',
        ncyBreadcrumb: {
            label: 'content.list.USERS'
        },
        resolve: loadSequence('ngTable', 'UsersCtrl', 'userService', 'companyService', 'countryService', 'cityService', 'languageService', 'groupService')
    }).state('app.access.usersnew', {
        url: '/users/new',
        templateUrl: '/bundles/sportclub/js/components/User/user_form.html',
        title: 'content.list.NEWUSER',
        ncyBreadcrumb: {
            label: 'content.list.NEWUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'cityService', 'languageService', 'groupService')
    }).state('app.access.usersedit', {
        url: '/users/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/User/user_form.html',
        title: 'content.list.EDITUSER',
        ncyBreadcrumb: {
            label: 'content.list.EDITUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'cityService', 'languageService', 'groupService')
    }).state('app.access.usersdetails', {
        url: '/users/details/:id',
        templateUrl: '/bundles/sportclub/js/components/User/user.html',
        ncyBreadcrumb: {
            label: 'content.list.USERDETAILS'
        },
        resolve: loadSequence('UserCtrl', 'userService')
    }).state('app.access.groups', {
        url: '/groups',
        templateUrl: '/bundles/sportclub/js/components/Group/groups.html',
        title: 'content.list.GROUPS',
        ncyBreadcrumb: {
            label: 'content.list.GROUPS'
        },
        resolve: loadSequence('ngTable', 'GroupsCtrl', 'groupService', 'userService')
    }).state('app.access.groupsnew', {
        url: '/groups/new',
        templateUrl: '/bundles/sportclub/js/components/Group/group_form.html',
        title: 'content.list.NEWGROUP',
        ncyBreadcrumb: {
            label: 'content.list.NEWGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'GroupFormCtrl', 'groupService', 'userService')
    }).state('app.access.groupsedit', {
        url: '/groups/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Group/group_form.html',
        title: 'content.list.EDITGROUP',
        ncyBreadcrumb: {
            label: 'content.list.EDITGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'GroupFormCtrl', 'groupService', 'userService')
    }).state('app.access.groupsdetails', {
        url: '/groups/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Group/group.html',
        ncyBreadcrumb: {
            label: 'content.list.GROUPDETAILS'
        },
        resolve: loadSequence('GroupCtrl', 'groupService')
    }).state('app.access.logs', {
        url: '/logs',
        templateUrl: '/bundles/sportclub/js/components/Log/logs.html',
        title: 'content.list.LOGS',
        ncyBreadcrumb: {
            label: 'content.list.LOGS'
        },
        resolve: loadSequence('ngTable', 'LogsCtrl', 'logService', 'userService')
    }).state('app.access.logsnew', {
        url: '/logs/new',
        templateUrl: '/bundles/sportclub/js/components/Log/log_form.html',
        title: 'content.list.NEWLOG',
        ncyBreadcrumb: {
            label: 'content.list.NEWLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'userService')
    }).state('app.access.logsedit', {
        url: '/logs/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Log/log_form.html',
        title: 'content.list.EDITLOG',
        ncyBreadcrumb: {
            label: 'content.list.EDITLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'userService')
    }).state('app.access.logsdetails', {
        url: '/logs/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Log/log.html',
        ncyBreadcrumb: {
            label: 'content.list.LOGDETAILS'
        },
        resolve: loadSequence('LogCtrl', 'logService')
    }).state('app.access.usersettings', {
        url: '/user-settings',
        templateUrl: '/bundles/sportclub/js/components/UserSetting/user_settings.html',
        title: 'content.list.USERSETTINGS',
        ncyBreadcrumb: {
            label: 'content.list.USERSETTINGS'
        },
        resolve: loadSequence('ngTable', 'UserSettingsCtrl', 'userSettingService', 'userService')
    }).state('app.access.usersettingsnew', {
        url: '/user-settings/new',
        templateUrl: '/bundles/sportclub/js/components/UserSetting/user_setting_form.html',
        title: 'content.list.NEWUSERSETTING',
        ncyBreadcrumb: {
            label: 'content.list.NEWUSERSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserSettingFormCtrl', 'userSettingService', 'userService')
    }).state('app.access.usersettingsedit', {
        url: '/user-settings/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/UserSetting/user_setting_form.html',
        title: 'content.list.EDITUSERSETTING',
        ncyBreadcrumb: {
            label: 'content.list.EDITUSERSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserSettingFormCtrl', 'userSettingService', 'userService')
    }).state('app.access.usersettingsdetails', {
        url: '/user-settings/details/:id',
        templateUrl: '/bundles/sportclub/js/components/UserSetting/user_setting.html',
        ncyBreadcrumb: {
            label: 'content.list.USERSETTINGDETAILS'
        },
        resolve: loadSequence('UserSettingCtrl', 'userSettingService')
    }).state('app.access.companies', {
        url: '/companies',
        templateUrl: '/bundles/sportclub/js/components/Company/companies.html',
        title: 'content.list.COMPANIES',
        ncyBreadcrumb: {
            label: 'content.list.COMPANIES'
        },
        resolve: loadSequence('ngTable', 'CompaniesCtrl', 'companyService', 'userService')
    }).state('app.access.companiesnew', {
        url: '/companies/new',
        templateUrl: '/bundles/sportclub/js/components/Company/company_form.html',
        title: 'content.list.NEWCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesedit', {
        url: '/companies/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Company/company_form.html',
        title: 'content.list.EDITCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesdetails', {
        url: '/companies/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Company/company.html',
        ncyBreadcrumb: {
            label: 'content.list.COMPANYDETAILS'
        },
        resolve: loadSequence('CompanyCtrl', 'companyService')
    }).state('app.events', {
        url: '/events',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.events.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.events.MAIN'
        }
    }).state('app.events.sports', {
        url: '/sports',
        templateUrl: '/bundles/sportclub/js/components/Sport/sports.html',
        title: 'content.list.SPORTS',
        ncyBreadcrumb: {
            label: 'content.list.SPORTS'
        },
        resolve: loadSequence('ngTable', 'SportsCtrl', 'sportService', 'userService')
    }).state('app.events.sportsnew', {
        url: '/sports/new',
        templateUrl: '/bundles/sportclub/js/components/Sport/sport_form.html',
        title: 'content.list.NEWSPORT',
        ncyBreadcrumb: {
            label: 'content.list.NEWSPORT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SportFormCtrl', 'sportService', 'userService')
    }).state('app.events.sportsedit', {
        url: '/sports/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Sport/sport_form.html',
        title: 'content.list.EDITSPORT',
        ncyBreadcrumb: {
            label: 'content.list.EDITSPORT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SportFormCtrl', 'sportService', 'userService')
    }).state('app.events.sportsdetails', {
        url: '/sports/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Sport/sport.html',
        ncyBreadcrumb: {
            label: 'content.list.SPORTDETAILS'
        },
        resolve: loadSequence('SportCtrl', 'sportService')
    }).state('app.events.sportevents', {
        url: '/sport-events',
        templateUrl: '/bundles/sportclub/js/components/SportEvent/sport_events.html',
        title: 'content.list.SPORTEVENTS',
        ncyBreadcrumb: {
            label: 'content.list.SPORTEVENTS'
        },
        resolve: loadSequence('ngTable', 'SportEventsCtrl', 'sportEventService', 'sportService', 'seasonService', 'postTypeService', 'postCategoryService', 'countryService', 'userService', 'teamService')
    }).state('app.events.sporteventsnew', {
        url: '/sport-events/new',
        templateUrl: '/bundles/sportclub/js/components/SportEvent/sport_event_form.html',
        title: 'content.list.NEWSPORTEVENT',
        ncyBreadcrumb: {
            label: 'content.list.NEWSPORTEVENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SportEventFormCtrl', 'sportEventService', 'sportService', 'seasonService', 'postTypeService', 'postCategoryService', 'countryService', 'userService', 'teamService')
    }).state('app.events.sporteventsedit', {
        url: '/sport-events/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/SportEvent/sport_event_form.html',
        title: 'content.list.EDITSPORTEVENT',
        ncyBreadcrumb: {
            label: 'content.list.EDITSPORTEVENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SportEventFormCtrl', 'sportEventService', 'sportService', 'seasonService', 'postTypeService', 'postCategoryService', 'countryService', 'userService', 'teamService')
    }).state('app.events.sporteventsdetails', {
        url: '/sport-events/details/:id',
        templateUrl: '/bundles/sportclub/js/components/SportEvent/sport_event.html',
        ncyBreadcrumb: {
            label: 'content.list.SPORTEVENTDETAILS'
        },
        resolve: loadSequence('SportEventCtrl', 'sportEventService')
    }).state('app.events.seasons', {
        url: '/seasons',
        templateUrl: '/bundles/sportclub/js/components/Season/seasons.html',
        title: 'content.list.SEASONS',
        ncyBreadcrumb: {
            label: 'content.list.SEASONS'
        },
        resolve: loadSequence('ngTable', 'SeasonsCtrl', 'seasonService', 'userService')
    }).state('app.events.seasonsnew', {
        url: '/seasons/new',
        templateUrl: '/bundles/sportclub/js/components/Season/season_form.html',
        title: 'content.list.NEWSEASON',
        ncyBreadcrumb: {
            label: 'content.list.NEWSEASON'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SeasonFormCtrl', 'seasonService', 'userService')
    }).state('app.events.seasonsedit', {
        url: '/seasons/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Season/season_form.html',
        title: 'content.list.EDITSEASON',
        ncyBreadcrumb: {
            label: 'content.list.EDITSEASON'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SeasonFormCtrl', 'seasonService', 'userService')
    }).state('app.events.seasonsdetails', {
        url: '/seasons/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Season/season.html',
        ncyBreadcrumb: {
            label: 'content.list.SEASONDETAILS'
        },
        resolve: loadSequence('SeasonCtrl', 'seasonService')
    }).state('app.events.days', {
        url: '/days',
        templateUrl: '/bundles/sportclub/js/components/Day/days.html',
        title: 'content.list.DAYS',
        ncyBreadcrumb: {
            label: 'content.list.DAYS'
        },
        resolve: loadSequence('ngTable', 'DaysCtrl', 'dayService', 'sportEventService', 'userService')
    }).state('app.events.daysnew', {
        url: '/days/new',
        templateUrl: '/bundles/sportclub/js/components/Day/day_form.html',
        title: 'content.list.NEWDAY',
        ncyBreadcrumb: {
            label: 'content.list.NEWDAY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'DayFormCtrl', 'dayService', 'sportEventService', 'userService')
    }).state('app.events.daysedit', {
        url: '/days/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Day/day_form.html',
        title: 'content.list.EDITDAY',
        ncyBreadcrumb: {
            label: 'content.list.EDITDAY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'DayFormCtrl', 'dayService', 'sportEventService', 'userService')
    }).state('app.events.daysdetails', {
        url: '/days/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Day/day.html',
        ncyBreadcrumb: {
            label: 'content.list.DAYDETAILS'
        },
        resolve: loadSequence('DayCtrl', 'dayService')
    }).state('app.events.teams', {
        url: '/teams',
        templateUrl: '/bundles/sportclub/js/components/Team/teams.html',
        title: 'content.list.TEAMS',
        ncyBreadcrumb: {
            label: 'content.list.TEAMS'
        },
        resolve: loadSequence('ngTable', 'TeamsCtrl', 'teamService', 'countryService', 'stadiumService', 'userService')
    }).state('app.events.teamsnew', {
        url: '/teams/new',
        templateUrl: '/bundles/sportclub/js/components/Team/team_form.html',
        title: 'content.list.NEWTEAM',
        ncyBreadcrumb: {
            label: 'content.list.NEWTEAM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TeamFormCtrl', 'teamService', 'countryService', 'stadiumService', 'userService')
    }).state('app.events.teamsedit', {
        url: '/teams/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Team/team_form.html',
        title: 'content.list.EDITTEAM',
        ncyBreadcrumb: {
            label: 'content.list.EDITTEAM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TeamFormCtrl', 'teamService', 'countryService', 'stadiumService', 'userService')
    }).state('app.events.teamsdetails', {
        url: '/teams/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Team/team.html',
        ncyBreadcrumb: {
            label: 'content.list.TEAMDETAILS'
        },
        resolve: loadSequence('TeamCtrl', 'teamService')
    }).state('app.events.playerstats', {
        url: '/player-stats',
        templateUrl: '/bundles/sportclub/js/components/PlayerStat/player_stats.html',
        title: 'content.list.PLAYERSTATS',
        ncyBreadcrumb: {
            label: 'content.list.PLAYERSTATS'
        },
        resolve: loadSequence('ngTable', 'PlayerStatsCtrl', 'playerStatService', 'playerService', 'seasonService', 'userService')
    }).state('app.events.playerstatsnew', {
        url: '/player-stats/new',
        templateUrl: '/bundles/sportclub/js/components/PlayerStat/player_stat_form.html',
        title: 'content.list.NEWPLAYERSTAT',
        ncyBreadcrumb: {
            label: 'content.list.NEWPLAYERSTAT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PlayerStatFormCtrl', 'playerStatService', 'playerService', 'seasonService', 'userService')
    }).state('app.events.playerstatsedit', {
        url: '/player-stats/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PlayerStat/player_stat_form.html',
        title: 'content.list.EDITPLAYERSTAT',
        ncyBreadcrumb: {
            label: 'content.list.EDITPLAYERSTAT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PlayerStatFormCtrl', 'playerStatService', 'playerService', 'seasonService', 'userService')
    }).state('app.events.playerstatsdetails', {
        url: '/player-stats/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PlayerStat/player_stat.html',
        ncyBreadcrumb: {
            label: 'content.list.PLAYERSTATDETAILS'
        },
        resolve: loadSequence('PlayerStatCtrl', 'playerStatService')
    }).state('app.events.players', {
        url: '/players',
        templateUrl: '/bundles/sportclub/js/components/Player/players.html',
        title: 'content.list.PLAYERS',
        ncyBreadcrumb: {
            label: 'content.list.PLAYERS'
        },
        resolve: loadSequence('ngTable', 'PlayersCtrl', 'playerService', 'countryService', 'teamService', 'userService')
    }).state('app.events.playersnew', {
        url: '/players/new',
        templateUrl: '/bundles/sportclub/js/components/Player/player_form.html',
        title: 'content.list.NEWPLAYER',
        ncyBreadcrumb: {
            label: 'content.list.NEWPLAYER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PlayerFormCtrl', 'playerService', 'countryService', 'teamService', 'userService')
    }).state('app.events.playersedit', {
        url: '/players/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Player/player_form.html',
        title: 'content.list.EDITPLAYER',
        ncyBreadcrumb: {
            label: 'content.list.EDITPLAYER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PlayerFormCtrl', 'playerService', 'countryService', 'teamService', 'userService')
    }).state('app.events.playersdetails', {
        url: '/players/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Player/player.html',
        ncyBreadcrumb: {
            label: 'content.list.PLAYERDETAILS'
        },
        resolve: loadSequence('PlayerCtrl', 'playerService')
    }).state('app.events.prizewinners', {
        url: '/prize-winners',
        templateUrl: '/bundles/sportclub/js/components/PrizeWinner/prize_winners.html',
        title: 'content.list.PRIZEWINNERS',
        ncyBreadcrumb: {
            label: 'content.list.PRIZEWINNERS'
        },
        resolve: loadSequence('ngTable', 'PrizeWinnersCtrl', 'prizeWinnerService', 'sportEventService', 'teamService', 'countryService', 'userService')
    }).state('app.events.prizewinnersnew', {
        url: '/prize-winners/new',
        templateUrl: '/bundles/sportclub/js/components/PrizeWinner/prize_winner_form.html',
        title: 'content.list.NEWPRIZEWINNER',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRIZEWINNER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PrizeWinnerFormCtrl', 'prizeWinnerService', 'sportEventService', 'teamService', 'countryService', 'userService')
    }).state('app.events.prizewinnersedit', {
        url: '/prize-winners/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PrizeWinner/prize_winner_form.html',
        title: 'content.list.EDITPRIZEWINNER',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRIZEWINNER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PrizeWinnerFormCtrl', 'prizeWinnerService', 'sportEventService', 'teamService', 'countryService', 'userService')
    }).state('app.events.prizewinnersdetails', {
        url: '/prize-winners/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PrizeWinner/prize_winner.html',
        ncyBreadcrumb: {
            label: 'content.list.PRIZEWINNERDETAILS'
        },
        resolve: loadSequence('PrizeWinnerCtrl', 'prizeWinnerService')
    }).state('app.events.scorers', {
        url: '/scorers',
        templateUrl: '/bundles/sportclub/js/components/Scorer/scorers.html',
        title: 'content.list.SCORERS',
        ncyBreadcrumb: {
            label: 'content.list.SCORERS'
        },
        resolve: loadSequence('ngTable', 'ScorersCtrl', 'scorerService', 'teamService', 'playerService', 'sportEventService', 'userService')
    }).state('app.events.scorersnew', {
        url: '/scorers/new',
        templateUrl: '/bundles/sportclub/js/components/Scorer/scorer_form.html',
        title: 'content.list.NEWSCORER',
        ncyBreadcrumb: {
            label: 'content.list.NEWSCORER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ScorerFormCtrl', 'scorerService', 'teamService', 'playerService', 'sportEventService', 'userService')
    }).state('app.events.scorersedit', {
        url: '/scorers/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Scorer/scorer_form.html',
        title: 'content.list.EDITSCORER',
        ncyBreadcrumb: {
            label: 'content.list.EDITSCORER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ScorerFormCtrl', 'scorerService', 'teamService', 'playerService', 'sportEventService', 'userService')
    }).state('app.events.scorersdetails', {
        url: '/scorers/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Scorer/scorer.html',
        ncyBreadcrumb: {
            label: 'content.list.SCORERDETAILS'
        },
        resolve: loadSequence('ScorerCtrl', 'scorerService')
    }).state('app.events.stadia', {
        url: '/stadia',
        templateUrl: '/bundles/sportclub/js/components/Stadium/stadia.html',
        title: 'content.list.STADIA',
        ncyBreadcrumb: {
            label: 'content.list.STADIA'
        },
        resolve: loadSequence('ngTable', 'StadiaCtrl', 'stadiumService', 'sportEventService', 'countryService', 'cityService', 'userService')
    }).state('app.events.stadianew', {
        url: '/stadia/new',
        templateUrl: '/bundles/sportclub/js/components/Stadium/stadium_form.html',
        title: 'content.list.NEWSTADIUM',
        ncyBreadcrumb: {
            label: 'content.list.NEWSTADIUM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'StadiumFormCtrl', 'stadiumService', 'sportEventService', 'countryService', 'cityService', 'userService')
    }).state('app.events.stadiaedit', {
        url: '/stadia/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Stadium/stadium_form.html',
        title: 'content.list.EDITSTADIUM',
        ncyBreadcrumb: {
            label: 'content.list.EDITSTADIUM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'StadiumFormCtrl', 'stadiumService', 'sportEventService', 'countryService', 'cityService', 'userService')
    }).state('app.events.stadiadetails', {
        url: '/stadia/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Stadium/stadium.html',
        ncyBreadcrumb: {
            label: 'content.list.STADIUMDETAILS'
        },
        resolve: loadSequence('StadiumCtrl', 'stadiumService')
    }).state('app.events.stats', {
        url: '/stats',
        templateUrl: '/bundles/sportclub/js/components/Stat/stats.html',
        title: 'content.list.STATS',
        ncyBreadcrumb: {
            label: 'content.list.STATS'
        },
        resolve: loadSequence('ngTable', 'StatsCtrl', 'statService', 'tableService', 'teamService', 'userService')
    }).state('app.events.statsnew', {
        url: '/stats/new',
        templateUrl: '/bundles/sportclub/js/components/Stat/stat_form.html',
        title: 'content.list.NEWSTAT',
        ncyBreadcrumb: {
            label: 'content.list.NEWSTAT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'StatFormCtrl', 'statService', 'tableService', 'teamService', 'userService')
    }).state('app.events.statsedit', {
        url: '/stats/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Stat/stat_form.html',
        title: 'content.list.EDITSTAT',
        ncyBreadcrumb: {
            label: 'content.list.EDITSTAT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'StatFormCtrl', 'statService', 'tableService', 'teamService', 'userService')
    }).state('app.events.statsdetails', {
        url: '/stats/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Stat/stat.html',
        ncyBreadcrumb: {
            label: 'content.list.STATDETAILS'
        },
        resolve: loadSequence('StatCtrl', 'statService')
    }).state('app.events.tables', {
        url: '/tables',
        templateUrl: '/bundles/sportclub/js/components/Table/tables.html',
        title: 'content.list.TABLES',
        ncyBreadcrumb: {
            label: 'content.list.TABLES'
        },
        resolve: loadSequence('ngTable', 'TablesCtrl', 'tableService', 'dayService', 'userService')
    }).state('app.events.tablesnew', {
        url: '/tables/new',
        templateUrl: '/bundles/sportclub/js/components/Table/table_form.html',
        title: 'content.list.NEWTABLE',
        ncyBreadcrumb: {
            label: 'content.list.NEWTABLE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TableFormCtrl', 'tableService', 'dayService', 'userService')
    }).state('app.events.tablesedit', {
        url: '/tables/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Table/table_form.html',
        title: 'content.list.EDITTABLE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTABLE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TableFormCtrl', 'tableService', 'dayService', 'userService')
    }).state('app.events.tablesdetails', {
        url: '/tables/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Table/table.html',
        ncyBreadcrumb: {
            label: 'content.list.TABLEDETAILS'
        },
        resolve: loadSequence('TableCtrl', 'tableService')
    }).state('app.events.tablesstats', {
        url: '/tables/stats/:id',
        templateUrl: '/bundles/sportclub/js/components/Table/table_stats.html',
        ncyBreadcrumb: {
            label: 'content.list.TABLESTATS'
        },
        resolve: loadSequence('TableStatsCtrl', 'TableStatsService', 'tableService')
    }).state('app.photos', {
        url: '/photos',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.photos.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.photos.MAIN'
        }
    }).state('app.photos.images', {
        url: '/images',
        templateUrl: '/bundles/sportclub/js/components/Image/images.html',
        title: 'content.list.IMAGES',
        ncyBreadcrumb: {
            label: 'content.list.IMAGES'
        },
        resolve: loadSequence('ngTable', 'ImagesCtrl', 'imageService', 'imageTypeService', 'priceService', 'sharingService', 'galleryService', 'userService', 'imageCategoryService')
    }).state('app.photos.imagesnew', {
        url: '/images/new',
        templateUrl: '/bundles/sportclub/js/components/Image/image_form.html',
        title: 'content.list.NEWIMAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWIMAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImageFormCtrl', 'imageService', 'imageTypeService', 'priceService', 'sharingService', 'galleryService', 'userService', 'imageCategoryService')
    }).state('app.photos.imagesedit', {
        url: '/images/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Image/image_form.html',
        title: 'content.list.EDITIMAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITIMAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImageFormCtrl', 'imageService', 'imageTypeService', 'priceService', 'sharingService', 'galleryService', 'userService', 'imageCategoryService')
    }).state('app.photos.imagesdetails', {
        url: '/images/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Image/image.html',
        ncyBreadcrumb: {
            label: 'content.list.IMAGEDETAILS'
        },
        resolve: loadSequence('ImageCtrl', 'imageService')
    }).state('app.photos.imagecategories', {
        url: '/image-categories',
        templateUrl: '/bundles/sportclub/js/components/ImageCategory/image_categories.html',
        title: 'content.list.IMAGECATEGORIES',
        ncyBreadcrumb: {
            label: 'content.list.IMAGECATEGORIES'
        },
        resolve: loadSequence('ngTable', 'ImageCategoriesCtrl', 'imageCategoryService', 'imageTypeService', 'userService')
    }).state('app.photos.imagecategoriesnew', {
        url: '/image-categories/new',
        templateUrl: '/bundles/sportclub/js/components/ImageCategory/image_category_form.html',
        title: 'content.list.NEWIMAGECATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.NEWIMAGECATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImageCategoryFormCtrl', 'imageCategoryService', 'imageTypeService', 'userService')
    }).state('app.photos.imagecategoriesedit', {
        url: '/image-categories/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/ImageCategory/image_category_form.html',
        title: 'content.list.EDITIMAGECATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.EDITIMAGECATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImageCategoryFormCtrl', 'imageCategoryService', 'imageTypeService', 'userService')
    }).state('app.photos.imagecategoriesdetails', {
        url: '/image-categories/details/:id',
        templateUrl: '/bundles/sportclub/js/components/ImageCategory/image_category.html',
        ncyBreadcrumb: {
            label: 'content.list.IMAGECATEGORYDETAILS'
        },
        resolve: loadSequence('ImageCategoryCtrl', 'imageCategoryService')
    }).state('app.photos.imagetypes', {
        url: '/image-types',
        templateUrl: '/bundles/sportclub/js/components/ImageType/image_types.html',
        title: 'content.list.IMAGETYPES',
        ncyBreadcrumb: {
            label: 'content.list.IMAGETYPES'
        },
        resolve: loadSequence('ngTable', 'ImageTypesCtrl', 'imageTypeService', 'userService')
    }).state('app.photos.imagetypesnew', {
        url: '/image-types/new',
        templateUrl: '/bundles/sportclub/js/components/ImageType/image_type_form.html',
        title: 'content.list.NEWIMAGETYPE',
        ncyBreadcrumb: {
            label: 'content.list.NEWIMAGETYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImageTypeFormCtrl', 'imageTypeService', 'userService')
    }).state('app.photos.imagetypesedit', {
        url: '/image-types/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/ImageType/image_type_form.html',
        title: 'content.list.EDITIMAGETYPE',
        ncyBreadcrumb: {
            label: 'content.list.EDITIMAGETYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ImageTypeFormCtrl', 'imageTypeService', 'userService')
    }).state('app.photos.imagetypesdetails', {
        url: '/image-types/details/:id',
        templateUrl: '/bundles/sportclub/js/components/ImageType/image_type.html',
        ncyBreadcrumb: {
            label: 'content.list.IMAGETYPEDETAILS'
        },
        resolve: loadSequence('ImageTypeCtrl', 'imageTypeService')
    }).state('app.photos.galleries', {
        url: '/galleries',
        templateUrl: '/bundles/sportclub/js/components/Gallery/galleries.html',
        title: 'content.list.GALLERIES',
        ncyBreadcrumb: {
            label: 'content.list.GALLERIES'
        },
        resolve: loadSequence('ngTable', 'GalleriesCtrl', 'galleryService', 'userService')
    }).state('app.photos.galleriesnew', {
        url: '/galleries/new',
        templateUrl: '/bundles/sportclub/js/components/Gallery/gallery_form.html',
        title: 'content.list.NEWGALLERY',
        ncyBreadcrumb: {
            label: 'content.list.NEWGALLERY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'GalleryFormCtrl', 'galleryService', 'userService')
    }).state('app.photos.galleriesedit', {
        url: '/galleries/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Gallery/gallery_form.html',
        title: 'content.list.EDITGALLERY',
        ncyBreadcrumb: {
            label: 'content.list.EDITGALLERY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'GalleryFormCtrl', 'galleryService', 'userService')
    }).state('app.photos.galleriesdetails', {
        url: '/galleries/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Gallery/gallery.html',
        ncyBreadcrumb: {
            label: 'content.list.GALLERYDETAILS'
        },
        resolve: loadSequence('GalleryCtrl', 'galleryService')
    }).state('app.statistics', {
        url: '/statistics',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.statistics.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.statistics.MAIN'
        }
    }).state('app.statistics.hits', {
        url: '/hits',
        templateUrl: '/bundles/sportclub/js/components/Hit/hits.html',
        title: 'content.list.HITS',
        ncyBreadcrumb: {
            label: 'content.list.HITS'
        },
        resolve: loadSequence('ngTable', 'HitsCtrl', 'hitService', 'visitService', 'userService')
    }).state('app.statistics.hitsnew', {
        url: '/hits/new',
        templateUrl: '/bundles/sportclub/js/components/Hit/hit_form.html',
        title: 'content.list.NEWHIT',
        ncyBreadcrumb: {
            label: 'content.list.NEWHIT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'HitFormCtrl', 'hitService', 'visitService', 'userService')
    }).state('app.statistics.hitsedit', {
        url: '/hits/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Hit/hit_form.html',
        title: 'content.list.EDITHIT',
        ncyBreadcrumb: {
            label: 'content.list.EDITHIT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'HitFormCtrl', 'hitService', 'visitService', 'userService')
    }).state('app.statistics.hitsdetails', {
        url: '/hits/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Hit/hit.html',
        ncyBreadcrumb: {
            label: 'content.list.HITDETAILS'
        },
        resolve: loadSequence('HitCtrl', 'hitService')
    }).state('app.statistics.visits', {
        url: '/visits',
        templateUrl: '/bundles/sportclub/js/components/Visit/visits.html',
        title: 'content.list.VISITS',
        ncyBreadcrumb: {
            label: 'content.list.VISITS'
        },
        resolve: loadSequence('ngTable', 'VisitsCtrl', 'visitService', 'userService')
    }).state('app.statistics.visitsnew', {
        url: '/visits/new',
        templateUrl: '/bundles/sportclub/js/components/Visit/visit_form.html',
        title: 'content.list.NEWVISIT',
        ncyBreadcrumb: {
            label: 'content.list.NEWVISIT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VisitFormCtrl', 'visitService', 'userService')
    }).state('app.statistics.visitsedit', {
        url: '/visits/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Visit/visit_form.html',
        title: 'content.list.EDITVISIT',
        ncyBreadcrumb: {
            label: 'content.list.EDITVISIT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VisitFormCtrl', 'visitService', 'userService')
    }).state('app.statistics.visitsdetails', {
        url: '/visits/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Visit/visit.html',
        ncyBreadcrumb: {
            label: 'content.list.VISITDETAILS'
        },
        resolve: loadSequence('VisitCtrl', 'visitService')
    }).state('app.matchday', {
        url: '/matchday',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.matchday.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.matchday.MAIN'
        }
    }).state('app.matchday.matches', {
        url: '/matches',
        templateUrl: '/bundles/sportclub/js/components/Match/matches.html',
        title: 'content.list.MATCHES',
        ncyBreadcrumb: {
            label: 'content.list.MATCHES'
        },
        resolve: loadSequence('ngTable', 'MatchesCtrl', 'matchService', 'galleryService', 'showService', 'dayService', 'teamService', 'countryService', 'cityService', 'stadiumService', 'userService')
    }).state('app.matchday.matchesnew', {
        url: '/matches/new',
        templateUrl: '/bundles/sportclub/js/components/Match/match_form.html',
        title: 'content.list.NEWMATCH',
        ncyBreadcrumb: {
            label: 'content.list.NEWMATCH'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchFormCtrl', 'matchService', 'galleryService', 'showService', 'dayService', 'teamService', 'countryService', 'cityService', 'stadiumService', 'userService')
    }).state('app.matchday.matchesedit', {
        url: '/matches/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Match/match_form.html',
        title: 'content.list.EDITMATCH',
        ncyBreadcrumb: {
            label: 'content.list.EDITMATCH'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchFormCtrl', 'matchService', 'galleryService', 'showService', 'dayService', 'teamService', 'countryService', 'cityService', 'stadiumService', 'userService')
    }).state('app.matchday.matchesdetails', {
        url: '/matches/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Match/match.html',
        ncyBreadcrumb: {
            label: 'content.list.MATCHDETAILS'
        },
        resolve: loadSequence('MatchCtrl', 'matchService')
    }).state('app.matchday.matchlineups', {
        url: '/match-line-ups',
        templateUrl: '/bundles/sportclub/js/components/MatchLineUp/match_line_ups.html',
        title: 'content.list.MATCHLINEUPS',
        ncyBreadcrumb: {
            label: 'content.list.MATCHLINEUPS'
        },
        resolve: loadSequence('ngTable', 'MatchLineUpsCtrl', 'matchLineUpService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchlineupsnew', {
        url: '/match-line-ups/new',
        templateUrl: '/bundles/sportclub/js/components/MatchLineUp/match_line_up_form.html',
        title: 'content.list.NEWMATCHLINEUP',
        ncyBreadcrumb: {
            label: 'content.list.NEWMATCHLINEUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchLineUpFormCtrl', 'matchLineUpService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchlineupsedit', {
        url: '/match-line-ups/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchLineUp/match_line_up_form.html',
        title: 'content.list.EDITMATCHLINEUP',
        ncyBreadcrumb: {
            label: 'content.list.EDITMATCHLINEUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchLineUpFormCtrl', 'matchLineUpService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchlineupsdetails', {
        url: '/match-line-ups/details/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchLineUp/match_line_up.html',
        ncyBreadcrumb: {
            label: 'content.list.MATCHLINEUPDETAILS'
        },
        resolve: loadSequence('MatchLineUpCtrl', 'matchLineUpService')
    }).state('app.matchday.matchcommentaries', {
        url: '/match-commentaries',
        templateUrl: '/bundles/sportclub/js/components/MatchCommentary/match_commentaries.html',
        title: 'content.list.MATCHCOMMENTARIES',
        ncyBreadcrumb: {
            label: 'content.list.MATCHCOMMENTARIES'
        },
        resolve: loadSequence('ngTable', 'MatchCommentariesCtrl', 'matchCommentaryService', 'matchService', 'userService')
    }).state('app.matchday.matchcommentariesnew', {
        url: '/match-commentaries/new',
        templateUrl: '/bundles/sportclub/js/components/MatchCommentary/match_commentary_form.html',
        title: 'content.list.NEWMATCHCOMMENTARY',
        ncyBreadcrumb: {
            label: 'content.list.NEWMATCHCOMMENTARY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchCommentaryFormCtrl', 'matchCommentaryService', 'matchService', 'userService')
    }).state('app.matchday.matchcommentariesedit', {
        url: '/match-commentaries/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchCommentary/match_commentary_form.html',
        title: 'content.list.EDITMATCHCOMMENTARY',
        ncyBreadcrumb: {
            label: 'content.list.EDITMATCHCOMMENTARY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchCommentaryFormCtrl', 'matchCommentaryService', 'matchService', 'userService')
    }).state('app.matchday.matchcommentariesdetails', {
        url: '/match-commentaries/details/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchCommentary/match_commentary.html',
        ncyBreadcrumb: {
            label: 'content.list.MATCHCOMMENTARYDETAILS'
        },
        resolve: loadSequence('MatchCommentaryCtrl', 'matchCommentaryService')
    }).state('app.matchday.matchgoals', {
        url: '/match-goals',
        templateUrl: '/bundles/sportclub/js/components/MatchGoal/match_goals.html',
        title: 'content.list.MATCHGOALS',
        ncyBreadcrumb: {
            label: 'content.list.MATCHGOALS'
        },
        resolve: loadSequence('ngTable', 'MatchGoalsCtrl', 'matchGoalService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchgoalsnew', {
        url: '/match-goals/new',
        templateUrl: '/bundles/sportclub/js/components/MatchGoal/match_goal_form.html',
        title: 'content.list.NEWMATCHGOAL',
        ncyBreadcrumb: {
            label: 'content.list.NEWMATCHGOAL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchGoalFormCtrl', 'matchGoalService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchgoalsedit', {
        url: '/match-goals/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchGoal/match_goal_form.html',
        title: 'content.list.EDITMATCHGOAL',
        ncyBreadcrumb: {
            label: 'content.list.EDITMATCHGOAL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchGoalFormCtrl', 'matchGoalService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchgoalsdetails', {
        url: '/match-goals/details/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchGoal/match_goal.html',
        ncyBreadcrumb: {
            label: 'content.list.MATCHGOALDETAILS'
        },
        resolve: loadSequence('MatchGoalCtrl', 'matchGoalService')
    }).state('app.matchday.matchcards', {
        url: '/match-cards',
        templateUrl: '/bundles/sportclub/js/components/MatchCard/match_cards.html',
        title: 'content.list.MATCHCARDS',
        ncyBreadcrumb: {
            label: 'content.list.MATCHCARDS'
        },
        resolve: loadSequence('ngTable', 'MatchCardsCtrl', 'matchCardService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchcardsnew', {
        url: '/match-cards/new',
        templateUrl: '/bundles/sportclub/js/components/MatchCard/match_card_form.html',
        title: 'content.list.NEWMATCHCARD',
        ncyBreadcrumb: {
            label: 'content.list.NEWMATCHCARD'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchCardFormCtrl', 'matchCardService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchcardsedit', {
        url: '/match-cards/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchCard/match_card_form.html',
        title: 'content.list.EDITMATCHCARD',
        ncyBreadcrumb: {
            label: 'content.list.EDITMATCHCARD'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchCardFormCtrl', 'matchCardService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchcardsdetails', {
        url: '/match-cards/details/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchCard/match_card.html',
        ncyBreadcrumb: {
            label: 'content.list.MATCHCARDDETAILS'
        },
        resolve: loadSequence('MatchCardCtrl', 'matchCardService')
    }).state('app.matchday.matchsubstitutions', {
        url: '/match-substitutions',
        templateUrl: '/bundles/sportclub/js/components/MatchSubstitution/match_substitutions.html',
        title: 'content.list.MATCHSUBSTITUTIONS',
        ncyBreadcrumb: {
            label: 'content.list.MATCHSUBSTITUTIONS'
        },
        resolve: loadSequence('ngTable', 'MatchSubstitutionsCtrl', 'matchSubstitutionService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchsubstitutionsnew', {
        url: '/match-substitutions/new',
        templateUrl: '/bundles/sportclub/js/components/MatchSubstitution/match_substitution_form.html',
        title: 'content.list.NEWMATCHSUBSTITUTION',
        ncyBreadcrumb: {
            label: 'content.list.NEWMATCHSUBSTITUTION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchSubstitutionFormCtrl', 'matchSubstitutionService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchsubstitutionsedit', {
        url: '/match-substitutions/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchSubstitution/match_substitution_form.html',
        title: 'content.list.EDITMATCHSUBSTITUTION',
        ncyBreadcrumb: {
            label: 'content.list.EDITMATCHSUBSTITUTION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'MatchSubstitutionFormCtrl', 'matchSubstitutionService', 'matchService', 'teamService', 'playerService', 'userService')
    }).state('app.matchday.matchsubstitutionsdetails', {
        url: '/match-substitutions/details/:id',
        templateUrl: '/bundles/sportclub/js/components/MatchSubstitution/match_substitution.html',
        ncyBreadcrumb: {
            label: 'content.list.MATCHSUBSTITUTIONDETAILS'
        },
        resolve: loadSequence('MatchSubstitutionCtrl', 'matchSubstitutionService')
    }).state('app.offer', {
        url: '/offer',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.offer.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.offer.MAIN'
        }
    }).state('app.offer.subscriptions', {
        url: '/subscriptions',
        templateUrl: '/bundles/sportclub/js/components/Subscription/subscriptions.html',
        title: 'content.list.SUBSCRIPTIONS',
        ncyBreadcrumb: {
            label: 'content.list.SUBSCRIPTIONS'
        },
        resolve: loadSequence('ngTable', 'SubscriptionsCtrl', 'subscriptionService', 'visitService', 'packageService', 'priceService', 'userService')
    }).state('app.offer.subscriptionsnew', {
        url: '/subscriptions/new',
        templateUrl: '/bundles/sportclub/js/components/Subscription/subscription_form.html',
        title: 'content.list.NEWSUBSCRIPTION',
        ncyBreadcrumb: {
            label: 'content.list.NEWSUBSCRIPTION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SubscriptionFormCtrl', 'subscriptionService', 'visitService', 'packageService', 'priceService', 'userService')
    }).state('app.offer.subscriptionsedit', {
        url: '/subscriptions/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Subscription/subscription_form.html',
        title: 'content.list.EDITSUBSCRIPTION',
        ncyBreadcrumb: {
            label: 'content.list.EDITSUBSCRIPTION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SubscriptionFormCtrl', 'subscriptionService', 'visitService', 'packageService', 'priceService', 'userService')
    }).state('app.offer.subscriptionsdetails', {
        url: '/subscriptions/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Subscription/subscription.html',
        ncyBreadcrumb: {
            label: 'content.list.SUBSCRIPTIONDETAILS'
        },
        resolve: loadSequence('SubscriptionCtrl', 'subscriptionService')
    }).state('app.offer.packages', {
        url: '/packages',
        templateUrl: '/bundles/sportclub/js/components/Package/packages.html',
        title: 'content.list.PACKAGES',
        ncyBreadcrumb: {
            label: 'content.list.PACKAGES'
        },
        resolve: loadSequence('ngTable', 'PackagesCtrl', 'packageService', 'packageTypeService', 'priceService', 'userService')
    }).state('app.offer.packagesnew', {
        url: '/packages/new',
        templateUrl: '/bundles/sportclub/js/components/Package/package_form.html',
        title: 'content.list.NEWPACKAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPACKAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PackageFormCtrl', 'packageService', 'packageTypeService', 'priceService', 'userService')
    }).state('app.offer.packagesedit', {
        url: '/packages/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Package/package_form.html',
        title: 'content.list.EDITPACKAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPACKAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PackageFormCtrl', 'packageService', 'packageTypeService', 'priceService', 'userService')
    }).state('app.offer.packagesdetails', {
        url: '/packages/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Package/package.html',
        ncyBreadcrumb: {
            label: 'content.list.PACKAGEDETAILS'
        },
        resolve: loadSequence('PackageCtrl', 'packageService')
    }).state('app.offer.packagetypes', {
        url: '/package-types',
        templateUrl: '/bundles/sportclub/js/components/PackageType/package_types.html',
        title: 'content.list.PACKAGETYPES',
        ncyBreadcrumb: {
            label: 'content.list.PACKAGETYPES'
        },
        resolve: loadSequence('ngTable', 'PackageTypesCtrl', 'packageTypeService', 'userService')
    }).state('app.offer.packagetypesnew', {
        url: '/package-types/new',
        templateUrl: '/bundles/sportclub/js/components/PackageType/package_type_form.html',
        title: 'content.list.NEWPACKAGETYPE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPACKAGETYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PackageTypeFormCtrl', 'packageTypeService', 'userService')
    }).state('app.offer.packagetypesedit', {
        url: '/package-types/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PackageType/package_type_form.html',
        title: 'content.list.EDITPACKAGETYPE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPACKAGETYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PackageTypeFormCtrl', 'packageTypeService', 'userService')
    }).state('app.offer.packagetypesdetails', {
        url: '/package-types/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PackageType/package_type.html',
        ncyBreadcrumb: {
            label: 'content.list.PACKAGETYPEDETAILS'
        },
        resolve: loadSequence('PackageTypeCtrl', 'packageTypeService')
    }).state('app.offer.prices', {
        url: '/prices',
        templateUrl: '/bundles/sportclub/js/components/Price/prices.html',
        title: 'content.list.PRICES',
        ncyBreadcrumb: {
            label: 'content.list.PRICES'
        },
        resolve: loadSequence('ngTable', 'PricesCtrl', 'priceService', 'userService')
    }).state('app.offer.pricesnew', {
        url: '/prices/new',
        templateUrl: '/bundles/sportclub/js/components/Price/price_form.html',
        title: 'content.list.NEWPRICE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRICE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PriceFormCtrl', 'priceService', 'userService')
    }).state('app.offer.pricesedit', {
        url: '/prices/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Price/price_form.html',
        title: 'content.list.EDITPRICE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRICE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PriceFormCtrl', 'priceService', 'userService')
    }).state('app.offer.pricesdetails', {
        url: '/prices/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Price/price.html',
        ncyBreadcrumb: {
            label: 'content.list.PRICEDETAILS'
        },
        resolve: loadSequence('PriceCtrl', 'priceService')
    }).state('app.offer.vouchers', {
        url: '/vouchers',
        templateUrl: '/bundles/sportclub/js/components/Voucher/vouchers.html',
        title: 'content.list.VOUCHERS',
        ncyBreadcrumb: {
            label: 'content.list.VOUCHERS'
        },
        resolve: loadSequence('ngTable', 'VouchersCtrl', 'voucherService', 'priceService', 'userService')
    }).state('app.offer.vouchersnew', {
        url: '/vouchers/new',
        templateUrl: '/bundles/sportclub/js/components/Voucher/voucher_form.html',
        title: 'content.list.NEWVOUCHER',
        ncyBreadcrumb: {
            label: 'content.list.NEWVOUCHER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VoucherFormCtrl', 'voucherService', 'priceService', 'userService')
    }).state('app.offer.vouchersedit', {
        url: '/vouchers/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Voucher/voucher_form.html',
        title: 'content.list.EDITVOUCHER',
        ncyBreadcrumb: {
            label: 'content.list.EDITVOUCHER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VoucherFormCtrl', 'voucherService', 'priceService', 'userService')
    }).state('app.offer.vouchersdetails', {
        url: '/vouchers/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Voucher/voucher.html',
        ncyBreadcrumb: {
            label: 'content.list.VOUCHERDETAILS'
        },
        resolve: loadSequence('VoucherCtrl', 'voucherService')
    }).state('app.offer.sharings', {
        url: '/sharings',
        templateUrl: '/bundles/sportclub/js/components/Sharing/sharings.html',
        title: 'content.list.SHARINGS',
        ncyBreadcrumb: {
            label: 'content.list.SHARINGS'
        },
        resolve: loadSequence('ngTable', 'SharingsCtrl', 'sharingService', 'userService')
    }).state('app.offer.sharingsnew', {
        url: '/sharings/new',
        templateUrl: '/bundles/sportclub/js/components/Sharing/sharing_form.html',
        title: 'content.list.NEWSHARING',
        ncyBreadcrumb: {
            label: 'content.list.NEWSHARING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SharingFormCtrl', 'sharingService', 'userService')
    }).state('app.offer.sharingsedit', {
        url: '/sharings/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Sharing/sharing_form.html',
        title: 'content.list.EDITSHARING',
        ncyBreadcrumb: {
            label: 'content.list.EDITSHARING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SharingFormCtrl', 'sharingService', 'userService')
    }).state('app.offer.sharingsdetails', {
        url: '/sharings/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Sharing/sharing.html',
        ncyBreadcrumb: {
            label: 'content.list.SHARINGDETAILS'
        },
        resolve: loadSequence('SharingCtrl', 'sharingService')
    }).state('app.news', {
        url: '/news',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.news.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.news.MAIN'
        }
    }).state('app.news.posts', {
        url: '/posts',
        templateUrl: '/bundles/sportclub/js/components/Post/posts.html',
        title: 'content.list.POSTS',
        ncyBreadcrumb: {
            label: 'content.list.POSTS'
        },
        resolve: loadSequence('ngTable', 'PostsCtrl', 'postService', 'postTypeService', 'userService', 'postCategoryService')
    }).state('app.news.postsnew', {
        url: '/posts/new',
        templateUrl: '/bundles/sportclub/js/components/Post/post_form.html',
        title: 'content.list.NEWPOST',
        ncyBreadcrumb: {
            label: 'content.list.NEWPOST'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PostFormCtrl', 'postService', 'postTypeService', 'userService', 'postCategoryService')
    }).state('app.news.postsedit', {
        url: '/posts/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Post/post_form.html',
        title: 'content.list.EDITPOST',
        ncyBreadcrumb: {
            label: 'content.list.EDITPOST'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PostFormCtrl', 'postService', 'postTypeService', 'userService', 'postCategoryService')
    }).state('app.news.postsdetails', {
        url: '/posts/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Post/post.html',
        ncyBreadcrumb: {
            label: 'content.list.POSTDETAILS'
        },
        resolve: loadSequence('PostCtrl', 'postService')
    }).state('app.news.postcategories', {
        url: '/post-categories',
        templateUrl: '/bundles/sportclub/js/components/PostCategory/post_categories.html',
        title: 'content.list.POSTCATEGORIES',
        ncyBreadcrumb: {
            label: 'content.list.POSTCATEGORIES'
        },
        resolve: loadSequence('ngTable', 'PostCategoriesCtrl', 'postCategoryService', 'postTypeService', 'userService')
    }).state('app.news.postcategoriesnew', {
        url: '/post-categories/new',
        templateUrl: '/bundles/sportclub/js/components/PostCategory/post_category_form.html',
        title: 'content.list.NEWPOSTCATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.NEWPOSTCATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PostCategoryFormCtrl', 'postCategoryService', 'postTypeService', 'userService')
    }).state('app.news.postcategoriesedit', {
        url: '/post-categories/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PostCategory/post_category_form.html',
        title: 'content.list.EDITPOSTCATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.EDITPOSTCATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PostCategoryFormCtrl', 'postCategoryService', 'postTypeService', 'userService')
    }).state('app.news.postcategoriesdetails', {
        url: '/post-categories/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PostCategory/post_category.html',
        ncyBreadcrumb: {
            label: 'content.list.POSTCATEGORYDETAILS'
        },
        resolve: loadSequence('PostCategoryCtrl', 'postCategoryService')
    }).state('app.news.posttypes', {
        url: '/post-types',
        templateUrl: '/bundles/sportclub/js/components/PostType/post_types.html',
        title: 'content.list.POSTTYPES',
        ncyBreadcrumb: {
            label: 'content.list.POSTTYPES'
        },
        resolve: loadSequence('ngTable', 'PostTypesCtrl', 'postTypeService', 'userService')
    }).state('app.news.posttypesnew', {
        url: '/post-types/new',
        templateUrl: '/bundles/sportclub/js/components/PostType/post_type_form.html',
        title: 'content.list.NEWPOSTTYPE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPOSTTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PostTypeFormCtrl', 'postTypeService', 'userService')
    }).state('app.news.posttypesedit', {
        url: '/post-types/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PostType/post_type_form.html',
        title: 'content.list.EDITPOSTTYPE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPOSTTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PostTypeFormCtrl', 'postTypeService', 'userService')
    }).state('app.news.posttypesdetails', {
        url: '/post-types/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PostType/post_type.html',
        ncyBreadcrumb: {
            label: 'content.list.POSTTYPEDETAILS'
        },
        resolve: loadSequence('PostTypeCtrl', 'postTypeService')
    }).state('app.mobile', {
        url: '/mobile',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.mobile.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.mobile.MAIN'
        }
    }).state('app.mobile.pushnotifications', {
        url: '/push-notifications',
        templateUrl: '/bundles/sportclub/js/components/PushNotification/push_notifications.html',
        title: 'content.list.PUSHNOTIFICATIONS',
        ncyBreadcrumb: {
            label: 'content.list.PUSHNOTIFICATIONS'
        },
        resolve: loadSequence('ngTable', 'PushNotificationsCtrl', 'pushNotificationService', 'matchService', 'matchSubstitutionService', 'matchGoalService', 'postService', 'videoService', 'audioService', 'galleryService', 'userService')
    }).state('app.mobile.pushnotificationsnew', {
        url: '/push-notifications/new',
        templateUrl: '/bundles/sportclub/js/components/PushNotification/push_notification_form.html',
        title: 'content.list.NEWPUSHNOTIFICATION',
        ncyBreadcrumb: {
            label: 'content.list.NEWPUSHNOTIFICATION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PushNotificationFormCtrl', 'pushNotificationService', 'matchService', 'matchSubstitutionService', 'matchGoalService', 'postService', 'videoService', 'audioService', 'galleryService', 'userService')
    }).state('app.mobile.pushnotificationsedit', {
        url: '/push-notifications/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PushNotification/push_notification_form.html',
        title: 'content.list.EDITPUSHNOTIFICATION',
        ncyBreadcrumb: {
            label: 'content.list.EDITPUSHNOTIFICATION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PushNotificationFormCtrl', 'pushNotificationService', 'matchService', 'matchSubstitutionService', 'matchGoalService', 'postService', 'videoService', 'audioService', 'galleryService', 'userService')
    }).state('app.mobile.pushnotificationsdetails', {
        url: '/push-notifications/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PushNotification/push_notification.html',
        ncyBreadcrumb: {
            label: 'content.list.PUSHNOTIFICATIONDETAILS'
        },
        resolve: loadSequence('PushNotificationCtrl', 'pushNotificationService')
    }).state('app.mobile.pushnotificationssend', {
        url: '/push-notifications/send/:id',
        templateUrl: '/bundles/sportclub/js/components/PushNotification/push_notification_sender.html',
        ncyBreadcrumb: {
            label: 'content.list.SENDPUSHNOTIFICATION'
        },
        resolve: loadSequence('PushNotificationSenderCtrl', 'PushNotificationSenderService', 'pushNotificationService')
    }).state('app.mobile.pushdevices', {
        url: '/push-devices',
        templateUrl: '/bundles/sportclub/js/components/PushDevice/push_devices.html',
        title: 'content.list.PUSHDEVICES',
        ncyBreadcrumb: {
            label: 'content.list.PUSHDEVICES'
        },
        resolve: loadSequence('ngTable', 'PushDevicesCtrl', 'pushDeviceService', 'userService')
    }).state('app.mobile.pushdevicesnew', {
        url: '/push-devices/new',
        templateUrl: '/bundles/sportclub/js/components/PushDevice/push_device_form.html',
        title: 'content.list.NEWPUSHDEVICE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPUSHDEVICE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PushDeviceFormCtrl', 'pushDeviceService', 'userService')
    }).state('app.mobile.pushdevicesedit', {
        url: '/push-devices/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PushDevice/push_device_form.html',
        title: 'content.list.EDITPUSHDEVICE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPUSHDEVICE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PushDeviceFormCtrl', 'pushDeviceService', 'userService')
    }).state('app.mobile.pushdevicesdetails', {
        url: '/push-devices/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PushDevice/push_device.html',
        ncyBreadcrumb: {
            label: 'content.list.PUSHDEVICEDETAILS'
        },
        resolve: loadSequence('PushDeviceCtrl', 'pushDeviceService')
    }).state('app.mobile.pushmessages', {
        url: '/push-messages',
        templateUrl: '/bundles/sportclub/js/components/PushMessage/push_messages.html',
        title: 'content.list.PUSHMESSAGES',
        ncyBreadcrumb: {
            label: 'content.list.PUSHMESSAGES'
        },
        resolve: loadSequence('ngTable', 'PushMessagesCtrl', 'pushMessageService', 'pushDeviceService', 'pushNotificationService', 'userService')
    }).state('app.mobile.pushmessagesnew', {
        url: '/push-messages/new',
        templateUrl: '/bundles/sportclub/js/components/PushMessage/push_message_form.html',
        title: 'content.list.NEWPUSHMESSAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPUSHMESSAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PushMessageFormCtrl', 'pushMessageService', 'pushDeviceService', 'pushNotificationService', 'userService')
    }).state('app.mobile.pushmessagesedit', {
        url: '/push-messages/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/PushMessage/push_message_form.html',
        title: 'content.list.EDITPUSHMESSAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPUSHMESSAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PushMessageFormCtrl', 'pushMessageService', 'pushDeviceService', 'pushNotificationService', 'userService')
    }).state('app.mobile.pushmessagesdetails', {
        url: '/push-messages/details/:id',
        templateUrl: '/bundles/sportclub/js/components/PushMessage/push_message.html',
        ncyBreadcrumb: {
            label: 'content.list.PUSHMESSAGEDETAILS'
        },
        resolve: loadSequence('PushMessageCtrl', 'pushMessageService')
    }).state('app.mobile.pushmessagessend', {
        url: '/push-messages/send/:id',
        templateUrl: '/bundles/sportclub/js/components/PushMessage/push_message_sender.html',
        ncyBreadcrumb: {
            label: 'content.list.SENDPUSHMESSAGE'
        },
        resolve: loadSequence('PushMessageSenderCtrl', 'PushMessageSenderService', 'pushMessageService')
    }).state('app.webtv', {
        url: '/web-t-v',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.webtv.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.webtv.MAIN'
        }
    }).state('app.webtv.videos', {
        url: '/videos',
        templateUrl: '/bundles/sportclub/js/components/Video/videos.html',
        title: 'content.list.VIDEOS',
        ncyBreadcrumb: {
            label: 'content.list.VIDEOS'
        },
        resolve: loadSequence('ngTable', 'VideosCtrl', 'videoService', 'videoTypeService', 'priceService', 'sharingService', 'showService', 'userService', 'videoCategoryService')
    }).state('app.webtv.videosnew', {
        url: '/videos/new',
        templateUrl: '/bundles/sportclub/js/components/Video/video_form.html',
        title: 'content.list.NEWVIDEO',
        ncyBreadcrumb: {
            label: 'content.list.NEWVIDEO'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VideoFormCtrl', 'videoService', 'videoTypeService', 'priceService', 'sharingService', 'showService', 'userService', 'videoCategoryService')
    }).state('app.webtv.videosedit', {
        url: '/videos/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Video/video_form.html',
        title: 'content.list.EDITVIDEO',
        ncyBreadcrumb: {
            label: 'content.list.EDITVIDEO'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VideoFormCtrl', 'videoService', 'videoTypeService', 'priceService', 'sharingService', 'showService', 'userService', 'videoCategoryService')
    }).state('app.webtv.videosdetails', {
        url: '/videos/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Video/video.html',
        ncyBreadcrumb: {
            label: 'content.list.VIDEODETAILS'
        },
        resolve: loadSequence('VideoCtrl', 'videoService')
    }).state('app.webtv.videosconvert', {
        url: '/videos/convert/:id',
        templateUrl: '/bundles/sportclub/js/components/Video/video_converter.html',
        ncyBreadcrumb: {
            label: 'content.list.CONVERTVIDEO'
        },
        resolve: loadSequence('VideoConverterCtrl', 'VideoConverterService', 'videoService')
    }).state('app.webtv.videocategories', {
        url: '/video-categories',
        templateUrl: '/bundles/sportclub/js/components/VideoCategory/video_categories.html',
        title: 'content.list.VIDEOCATEGORIES',
        ncyBreadcrumb: {
            label: 'content.list.VIDEOCATEGORIES'
        },
        resolve: loadSequence('ngTable', 'VideoCategoriesCtrl', 'videoCategoryService', 'videoTypeService', 'userService')
    }).state('app.webtv.videocategoriesnew', {
        url: '/video-categories/new',
        templateUrl: '/bundles/sportclub/js/components/VideoCategory/video_category_form.html',
        title: 'content.list.NEWVIDEOCATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.NEWVIDEOCATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VideoCategoryFormCtrl', 'videoCategoryService', 'videoTypeService', 'userService')
    }).state('app.webtv.videocategoriesedit', {
        url: '/video-categories/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/VideoCategory/video_category_form.html',
        title: 'content.list.EDITVIDEOCATEGORY',
        ncyBreadcrumb: {
            label: 'content.list.EDITVIDEOCATEGORY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VideoCategoryFormCtrl', 'videoCategoryService', 'videoTypeService', 'userService')
    }).state('app.webtv.videocategoriesdetails', {
        url: '/video-categories/details/:id',
        templateUrl: '/bundles/sportclub/js/components/VideoCategory/video_category.html',
        ncyBreadcrumb: {
            label: 'content.list.VIDEOCATEGORYDETAILS'
        },
        resolve: loadSequence('VideoCategoryCtrl', 'videoCategoryService')
    }).state('app.webtv.videotypes', {
        url: '/video-types',
        templateUrl: '/bundles/sportclub/js/components/VideoType/video_types.html',
        title: 'content.list.VIDEOTYPES',
        ncyBreadcrumb: {
            label: 'content.list.VIDEOTYPES'
        },
        resolve: loadSequence('ngTable', 'VideoTypesCtrl', 'videoTypeService', 'userService')
    }).state('app.webtv.videotypesnew', {
        url: '/video-types/new',
        templateUrl: '/bundles/sportclub/js/components/VideoType/video_type_form.html',
        title: 'content.list.NEWVIDEOTYPE',
        ncyBreadcrumb: {
            label: 'content.list.NEWVIDEOTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VideoTypeFormCtrl', 'videoTypeService', 'userService')
    }).state('app.webtv.videotypesedit', {
        url: '/video-types/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/VideoType/video_type_form.html',
        title: 'content.list.EDITVIDEOTYPE',
        ncyBreadcrumb: {
            label: 'content.list.EDITVIDEOTYPE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'VideoTypeFormCtrl', 'videoTypeService', 'userService')
    }).state('app.webtv.videotypesdetails', {
        url: '/video-types/details/:id',
        templateUrl: '/bundles/sportclub/js/components/VideoType/video_type.html',
        ncyBreadcrumb: {
            label: 'content.list.VIDEOTYPEDETAILS'
        },
        resolve: loadSequence('VideoTypeCtrl', 'videoTypeService')
    }).state('app.webtv.shows', {
        url: '/shows',
        templateUrl: '/bundles/sportclub/js/components/Show/shows.html',
        title: 'content.list.SHOWS',
        ncyBreadcrumb: {
            label: 'content.list.SHOWS'
        },
        resolve: loadSequence('ngTable', 'ShowsCtrl', 'showService', 'userService')
    }).state('app.webtv.showsnew', {
        url: '/shows/new',
        templateUrl: '/bundles/sportclub/js/components/Show/show_form.html',
        title: 'content.list.NEWSHOW',
        ncyBreadcrumb: {
            label: 'content.list.NEWSHOW'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ShowFormCtrl', 'showService', 'userService')
    }).state('app.webtv.showsedit', {
        url: '/shows/edit/:id',
        templateUrl: '/bundles/sportclub/js/components/Show/show_form.html',
        title: 'content.list.EDITSHOW',
        ncyBreadcrumb: {
            label: 'content.list.EDITSHOW'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ShowFormCtrl', 'showService', 'userService')
    }).state('app.webtv.showsdetails', {
        url: '/shows/details/:id',
        templateUrl: '/bundles/sportclub/js/components/Show/show.html',
        ncyBreadcrumb: {
            label: 'content.list.SHOWDETAILS'
        },
        resolve: loadSequence('ShowCtrl', 'showService')
    });

}]);
