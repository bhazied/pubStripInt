
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
        templateUrl: '/bundles/publipr/js/components/Auth/login.html',
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
        templateUrl: '/bundles/publipr/js/components/Auth/register.html',
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
        templateUrl: '/bundles/publipr/js/components/Auth/reset_password.html',
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
        templateUrl: '/bundles/publipr/js/components/Auth/email_confirm.html',
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
        templateUrl: '/bundles/publipr/js/components/Auth/reset.html',
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
        templateUrl: '/bundles/publipr/js/components/Auth/lock_screen.html',
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
        templateUrl: '/bundles/publipr/js/components/Auth/profile.html',
        title: 'topbar.user.PROFILE',
        ncyBreadcrumb: {
            label: 'topbar.user.PROFILE'
        },
        resolve: loadSequence('jquery-sparkline', 'ProfileCtrl', 'ProfileService')
    }).state('app.changepassword', {
        url: '/change-password',
        templateUrl: '/bundles/publipr/js/components/Auth/change_password.html',
        title: 'topbar.user.CHANGEPASSWORD',
        ncyBreadcrumb: {
            label: 'topbar.user.CHANGEPASSWORD'
        },
        resolve: loadSequence('jquery-sparkline', 'ChangePasswordCtrl', 'ProfileService')
    }).state('app.dashboard', {
        url: '/dashboard',
        templateUrl: '/bundles/publipr/js/components/Main/dashboard.html',
        title: 'content.list.DASHBOARD',
        ncyBreadcrumb: {
            label: 'content.list.DASHBOARD'
        },
        resolve: loadSequence('jquery-sparkline', 'DashboardCtrl', 'DashboardService')
    }).state('app.access', {
        url: '/access',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.access.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.access.MAIN'
        }
    }).state('app.access.users', {
        url: '/users',
        templateUrl: '/bundles/publipr/js/components/User/users.html',
        title: 'content.list.USERS',
        ncyBreadcrumb: {
            label: 'content.list.USERS'
        },
        resolve: loadSequence('ngTable', 'UsersCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersnew', {
        url: '/users/new',
        templateUrl: '/bundles/publipr/js/components/User/user_form.html',
        title: 'content.list.NEWUSER',
        ncyBreadcrumb: {
            label: 'content.list.NEWUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersedit', {
        url: '/users/edit/:id',
        templateUrl: '/bundles/publipr/js/components/User/user_form.html',
        title: 'content.list.EDITUSER',
        ncyBreadcrumb: {
            label: 'content.list.EDITUSER'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'UserFormCtrl', 'userService', 'companyService', 'countryService', 'languageService')
    }).state('app.access.usersdetails', {
        url: '/users/details/:id',
        templateUrl: '/bundles/publipr/js/components/User/user.html',
        ncyBreadcrumb: {
            label: 'content.list.USERDETAILS'
        },
        resolve: loadSequence('UserCtrl', 'userService')
    }).state('app.access.companies', {
        url: '/companies',
        templateUrl: '/bundles/publipr/js/components/Company/companies.html',
        title: 'content.list.COMPANIES',
        ncyBreadcrumb: {
            label: 'content.list.COMPANIES'
        },
        resolve: loadSequence('ngTable', 'CompaniesCtrl', 'companyService', 'userService')
    }).state('app.access.companiesnew', {
        url: '/companies/new',
        templateUrl: '/bundles/publipr/js/components/Company/company_form.html',
        title: 'content.list.NEWCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesedit', {
        url: '/companies/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Company/company_form.html',
        title: 'content.list.EDITCOMPANY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOMPANY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CompanyFormCtrl', 'companyService', 'userService')
    }).state('app.access.companiesdetails', {
        url: '/companies/details/:id',
        templateUrl: '/bundles/publipr/js/components/Company/company.html',
        ncyBreadcrumb: {
            label: 'content.list.COMPANYDETAILS'
        },
        resolve: loadSequence('CompanyCtrl', 'companyService')
    }).state('app.access.logs', {
        url: '/logs',
        templateUrl: '/bundles/publipr/js/components/Log/logs.html',
        title: 'content.list.LOGS',
        ncyBreadcrumb: {
            label: 'content.list.LOGS'
        },
        resolve: loadSequence('ngTable', 'LogsCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.access.logsnew', {
        url: '/logs/new',
        templateUrl: '/bundles/publipr/js/components/Log/log_form.html',
        title: 'content.list.NEWLOG',
        ncyBreadcrumb: {
            label: 'content.list.NEWLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.access.logsedit', {
        url: '/logs/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Log/log_form.html',
        title: 'content.list.EDITLOG',
        ncyBreadcrumb: {
            label: 'content.list.EDITLOG'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LogFormCtrl', 'logService', 'sessionService', 'userService')
    }).state('app.access.logsdetails', {
        url: '/logs/details/:id',
        templateUrl: '/bundles/publipr/js/components/Log/log.html',
        ncyBreadcrumb: {
            label: 'content.list.LOGDETAILS'
        },
        resolve: loadSequence('LogCtrl', 'logService')
    }).state('app.contactmanager', {
        url: '/contact-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.contactmanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.contactmanager.MAIN'
        }
    }).state('app.contactmanager.contactgroups', {
        url: '/contact-groups',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_groups.html',
        title: 'content.list.CONTACTGROUPS',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTGROUPS'
        },
        resolve: loadSequence('ngTable', 'ContactGroupsCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsnew', {
        url: '/contact-groups/new',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group_form.html',
        title: 'content.list.NEWCONTACTGROUP',
        ncyBreadcrumb: {
            label: 'content.list.NEWCONTACTGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactGroupFormCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsedit', {
        url: '/contact-groups/edit/:id',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group_form.html',
        title: 'content.list.EDITCONTACTGROUP',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTACTGROUP'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactGroupFormCtrl', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactgroupsdetails', {
        url: '/contact-groups/details/:id',
        templateUrl: '/bundles/publipr/js/components/ContactGroup/contact_group.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTGROUPDETAILS'
        },
        resolve: loadSequence('ContactGroupCtrl', 'contactGroupService')
    }).state('app.contactmanager.contacts', {
        url: '/contacts',
        templateUrl: '/bundles/publipr/js/components/Contact/contacts.html',
        title: 'content.list.CONTACTS',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTS'
        },
        resolve: loadSequence('ngTable', 'ContactsCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsnew', {
        url: '/contacts/new',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_form.html',
        title: 'content.list.NEWCONTACT',
        ncyBreadcrumb: {
            label: 'content.list.NEWCONTACT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactFormCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsedit', {
        url: '/contacts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_form.html',
        title: 'content.list.EDITCONTACT',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTACT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContactFormCtrl', 'contactService', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsdetails', {
        url: '/contacts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Contact/contact.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTACTDETAILS'
        },
        resolve: loadSequence('ContactCtrl', 'contactService')
    }).state('app.contactmanager.contactsimport', {
        url: '/contacts/import',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_import.html',
        ncyBreadcrumb: {
            label: 'content.list.IMPORTCONTACTS'
        },
        resolve: loadSequence('ContactImportCtrl', 'ContactImportService', 'contactService', 'touchspin-plugin', 'contactGroupService', 'userService')
    }).state('app.contactmanager.contactsexport', {
        url: '/contacts/export',
        templateUrl: '/bundles/publipr/js/components/Contact/contact_export.html',
        ncyBreadcrumb: {
            label: 'content.list.IMPORTCONTACTS'
        },
        resolve: loadSequence('ContactExportCtrl', 'ContactExportService', 'contactService', 'contactGroupService', 'userService')
    }).state('app.templatemanager', {
        url: '/template-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.templatemanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.templatemanager.MAIN'
        }
    }).state('app.templatemanager.templates', {
        url: '/templates',
        templateUrl: '/bundles/publipr/js/components/Template/templates.html',
        title: 'content.list.TEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.TEMPLATES'
        },
        resolve: loadSequence('ngTable', 'TemplatesCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesnew', {
        url: '/templates/new',
        templateUrl: '/bundles/publipr/js/components/Template/template_form.html',
        title: 'content.list.NEWTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TemplateFormCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesedit', {
        url: '/templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Template/template_form.html',
        title: 'content.list.EDITTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TemplateFormCtrl', 'templateService', 'userService')
    }).state('app.templatemanager.templatesdetails', {
        url: '/templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/Template/template.html',
        ncyBreadcrumb: {
            label: 'content.list.TEMPLATEDETAILS'
        },
        resolve: loadSequence('TemplateCtrl', 'templateService')
    }).state('app.templatemanager.layouts', {
        url: '/layouts',
        templateUrl: '/bundles/publipr/js/components/Layout/layouts.html',
        title: 'content.list.LAYOUTS',
        ncyBreadcrumb: {
            label: 'content.list.LAYOUTS'
        },
        resolve: loadSequence('ngTable', 'LayoutsCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsnew', {
        url: '/layouts/new',
        templateUrl: '/bundles/publipr/js/components/Layout/layout_form.html',
        title: 'content.list.NEWLAYOUT',
        ncyBreadcrumb: {
            label: 'content.list.NEWLAYOUT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LayoutFormCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsedit', {
        url: '/layouts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Layout/layout_form.html',
        title: 'content.list.EDITLAYOUT',
        ncyBreadcrumb: {
            label: 'content.list.EDITLAYOUT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LayoutFormCtrl', 'layoutService', 'userService')
    }).state('app.templatemanager.layoutsdetails', {
        url: '/layouts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Layout/layout.html',
        ncyBreadcrumb: {
            label: 'content.list.LAYOUTDETAILS'
        },
        resolve: loadSequence('LayoutCtrl', 'layoutService')
    }).state('app.templatemanager.contentblocks', {
        url: '/content-blocks',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_blocks.html',
        title: 'content.list.CONTENTBLOCKS',
        ncyBreadcrumb: {
            label: 'content.list.CONTENTBLOCKS'
        },
        resolve: loadSequence('ngTable', 'ContentBlocksCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksnew', {
        url: '/content-blocks/new',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block_form.html',
        title: 'content.list.NEWCONTENTBLOCK',
        ncyBreadcrumb: {
            label: 'content.list.NEWCONTENTBLOCK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContentBlockFormCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksedit', {
        url: '/content-blocks/edit/:id',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block_form.html',
        title: 'content.list.EDITCONTENTBLOCK',
        ncyBreadcrumb: {
            label: 'content.list.EDITCONTENTBLOCK'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ContentBlockFormCtrl', 'contentBlockService', 'userService')
    }).state('app.templatemanager.contentblocksdetails', {
        url: '/content-blocks/details/:id',
        templateUrl: '/bundles/publipr/js/components/ContentBlock/content_block.html',
        ncyBreadcrumb: {
            label: 'content.list.CONTENTBLOCKDETAILS'
        },
        resolve: loadSequence('ContentBlockCtrl', 'contentBlockService')
    }).state('app.templatemanager.fonts', {
        url: '/fonts',
        templateUrl: '/bundles/publipr/js/components/Font/fonts.html',
        title: 'content.list.FONTS',
        ncyBreadcrumb: {
            label: 'content.list.FONTS'
        },
        resolve: loadSequence('ngTable', 'FontsCtrl', 'fontService', 'userService')
    }).state('app.templatemanager.fontsnew', {
        url: '/fonts/new',
        templateUrl: '/bundles/publipr/js/components/Font/font_form.html',
        title: 'content.list.NEWFONT',
        ncyBreadcrumb: {
            label: 'content.list.NEWFONT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'FontFormCtrl', 'fontService', 'userService')
    }).state('app.templatemanager.fontsedit', {
        url: '/fonts/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Font/font_form.html',
        title: 'content.list.EDITFONT',
        ncyBreadcrumb: {
            label: 'content.list.EDITFONT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'FontFormCtrl', 'fontService', 'userService')
    }).state('app.templatemanager.fontsdetails', {
        url: '/fonts/details/:id',
        templateUrl: '/bundles/publipr/js/components/Font/font.html',
        ncyBreadcrumb: {
            label: 'content.list.FONTDETAILS'
        },
        resolve: loadSequence('FontCtrl', 'fontService')
    }).state('app.configuration', {
        url: '/configuration',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.configuration.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.configuration.MAIN'
        }
    }).state('app.configuration.languages', {
        url: '/languages',
        templateUrl: '/bundles/publipr/js/components/Language/languages.html',
        title: 'content.list.LANGUAGES',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGES'
        },
        resolve: loadSequence('ngTable', 'LanguagesCtrl', 'languageService', 'userService')
    }).state('app.configuration.languagesnew', {
        url: '/languages/new',
        templateUrl: '/bundles/publipr/js/components/Language/language_form.html',
        title: 'content.list.NEWLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.NEWLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.configuration.languagesedit', {
        url: '/languages/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Language/language_form.html',
        title: 'content.list.EDITLANGUAGE',
        ncyBreadcrumb: {
            label: 'content.list.EDITLANGUAGE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'LanguageFormCtrl', 'languageService', 'userService')
    }).state('app.configuration.languagesdetails', {
        url: '/languages/details/:id',
        templateUrl: '/bundles/publipr/js/components/Language/language.html',
        ncyBreadcrumb: {
            label: 'content.list.LANGUAGEDETAILS'
        },
        resolve: loadSequence('LanguageCtrl', 'languageService')
    }).state('app.configuration.emailtemplates', {
        url: '/email-templates',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_templates.html',
        title: 'content.list.EMAILTEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.EMAILTEMPLATES'
        },
        resolve: loadSequence('ngTable', 'EmailTemplatesCtrl', 'emailTemplateService', 'userService')
    }).state('app.configuration.emailtemplatesnew', {
        url: '/email-templates/new',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template_form.html',
        title: 'content.list.NEWEMAILTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAILTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailTemplateFormCtrl', 'emailTemplateService', 'userService')
    }).state('app.configuration.emailtemplatesedit', {
        url: '/email-templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template_form.html',
        title: 'content.list.EDITEMAILTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAILTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailTemplateFormCtrl', 'emailTemplateService', 'userService')
    }).state('app.configuration.emailtemplatesdetails', {
        url: '/email-templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/EmailTemplate/email_template.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILTEMPLATEDETAILS'
        },
        resolve: loadSequence('EmailTemplateCtrl', 'emailTemplateService')
    }).state('app.configuration.countries', {
        url: '/countries',
        templateUrl: '/bundles/publipr/js/components/Country/countries.html',
        title: 'content.list.COUNTRIES',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRIES'
        },
        resolve: loadSequence('ngTable', 'CountriesCtrl', 'countryService', 'userService')
    }).state('app.configuration.countriesnew', {
        url: '/countries/new',
        templateUrl: '/bundles/publipr/js/components/Country/country_form.html',
        title: 'content.list.NEWCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.NEWCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.configuration.countriesedit', {
        url: '/countries/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Country/country_form.html',
        title: 'content.list.EDITCOUNTRY',
        ncyBreadcrumb: {
            label: 'content.list.EDITCOUNTRY'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'CountryFormCtrl', 'countryService', 'userService')
    }).state('app.configuration.countriesdetails', {
        url: '/countries/details/:id',
        templateUrl: '/bundles/publipr/js/components/Country/country.html',
        ncyBreadcrumb: {
            label: 'content.list.COUNTRYDETAILS'
        },
        resolve: loadSequence('CountryCtrl', 'countryService')
    }).state('app.configuration.settings', {
        url: '/settings',
        templateUrl: '/bundles/publipr/js/components/Setting/settings.html',
        title: 'content.list.SETTINGS',
        ncyBreadcrumb: {
            label: 'content.list.SETTINGS'
        },
        resolve: loadSequence('ngTable', 'SettingsCtrl', 'settingService', 'userService')
    }).state('app.configuration.settingsnew', {
        url: '/settings/new',
        templateUrl: '/bundles/publipr/js/components/Setting/setting_form.html',
        title: 'content.list.NEWSETTING',
        ncyBreadcrumb: {
            label: 'content.list.NEWSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SettingFormCtrl', 'settingService', 'userService')
    }).state('app.configuration.settingsedit', {
        url: '/settings/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Setting/setting_form.html',
        title: 'content.list.EDITSETTING',
        ncyBreadcrumb: {
            label: 'content.list.EDITSETTING'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SettingFormCtrl', 'settingService', 'userService')
    }).state('app.configuration.settingsdetails', {
        url: '/settings/details/:id',
        templateUrl: '/bundles/publipr/js/components/Setting/setting.html',
        ncyBreadcrumb: {
            label: 'content.list.SETTINGDETAILS'
        },
        resolve: loadSequence('SettingCtrl', 'settingService')
    }).state('app.distribution', {
        url: '/distribution',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.distribution.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.distribution.MAIN'
        }
    }).state('app.distribution.emails', {
        url: '/emails',
        templateUrl: '/bundles/publipr/js/components/Email/emails.html',
        title: 'content.list.EMAILS',
        ncyBreadcrumb: {
            label: 'content.list.EMAILS'
        },
        resolve: loadSequence('ngTable', 'EmailsCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsnew', {
        url: '/emails/new',
        templateUrl: '/bundles/publipr/js/components/Email/email_form.html',
        title: 'content.list.NEWEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailFormCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsedit', {
        url: '/emails/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Email/email_form.html',
        title: 'content.list.EDITEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailFormCtrl', 'emailService', 'pressReleaseService', 'contactService', 'userService')
    }).state('app.distribution.emailsdetails', {
        url: '/emails/details/:id',
        templateUrl: '/bundles/publipr/js/components/Email/email.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILDETAILS'
        },
        resolve: loadSequence('EmailCtrl', 'emailService')
    }).state('app.distribution.emailcampaigns', {
        url: '/email-campaigns',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaigns.html',
        title: 'content.list.EMAILCAMPAIGNS',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCAMPAIGNS'
        },
        resolve: loadSequence('ngTable', 'EmailCampaignsCtrl', 'emailCampaignService', 'pressReleaseService', 'userService', 'contactGroupService')
    }).state('app.distribution.emailcampaignsnew', {
        url: '/email-campaigns/new',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign_form.html',
        title: 'content.list.NEWEMAILCAMPAIGN',
        ncyBreadcrumb: {
            label: 'content.list.NEWEMAILCAMPAIGN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailCampaignFormCtrl', 'emailCampaignService', 'pressReleaseService', 'userService', 'contactGroupService')
    }).state('app.distribution.emailcampaignsedit', {
        url: '/email-campaigns/edit/:id',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign_form.html',
        title: 'content.list.EDITEMAILCAMPAIGN',
        ncyBreadcrumb: {
            label: 'content.list.EDITEMAILCAMPAIGN'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'EmailCampaignFormCtrl', 'emailCampaignService', 'pressReleaseService', 'userService', 'contactGroupService')
    }).state('app.distribution.emailcampaignsdetails', {
        url: '/email-campaigns/details/:id',
        templateUrl: '/bundles/publipr/js/components/EmailCampaign/email_campaign.html',
        ncyBreadcrumb: {
            label: 'content.list.EMAILCAMPAIGNDETAILS'
        },
        resolve: loadSequence('EmailCampaignCtrl', 'emailCampaignService')
    }).state('app.prmanager', {
        url: '/p-r-manager',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.prmanager.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.prmanager.MAIN'
        }
    }).state('app.prmanager.newsrooms', {
        url: '/newsrooms',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsrooms.html',
        title: 'content.list.NEWSROOMS',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMS'
        },
        resolve: loadSequence('ngTable', 'NewsroomsCtrl', 'newsroomService', 'fontService', 'userService', 'userService')
    }).state('app.prmanager.newsroomsnew', {
        url: '/newsrooms/new',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom_form.html',
        title: 'content.list.NEWNEWSROOM',
        ncyBreadcrumb: {
            label: 'content.list.NEWNEWSROOM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomFormCtrl', 'newsroomService', 'fontService', 'userService', 'userService')
    }).state('app.prmanager.newsroomsedit', {
        url: '/newsrooms/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom_form.html',
        title: 'content.list.EDITNEWSROOM',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOM'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomFormCtrl', 'newsroomService', 'fontService', 'userService', 'userService')
    }).state('app.prmanager.newsroomsdetails', {
        url: '/newsrooms/details/:id',
        templateUrl: '/bundles/publipr/js/components/Newsroom/newsroom.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMDETAILS'
        },
        resolve: loadSequence('NewsroomCtrl', 'newsroomService')
    }).state('app.prmanager.pressreleases', {
        url: '/press-releases',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_releases.html',
        title: 'content.list.PRESSRELEASES',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASES'
        },
        resolve: loadSequence('ngTable', 'PressReleasesCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.prmanager.pressreleasesnew', {
        url: '/press-releases/new',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_form.html',
        title: 'content.list.NEWPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PressReleaseFormCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.prmanager.pressreleasesedit', {
        url: '/press-releases/edit/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_form.html',
        title: 'content.list.EDITPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PressReleaseFormCtrl', 'pressReleaseService', 'newsroomService', 'userService')
    }).state('app.prmanager.pressreleasesdetails', {
        url: '/press-releases/details/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASEDETAILS'
        },
        resolve: loadSequence('PressReleaseCtrl', 'pressReleaseService')
    }).state('app.prmanager.pressreleaseseditor', {
        url: '/press-releases/editor/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_editor.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASEEDITOR'
        },
        data: {
            appClasses: 'bg-white usersession',
            contentClasses: 'full-height'
        },
        resolve: loadSequence('PressReleaseEditorCtrl', 'contentBlockService', 'layoutService', 'newsroomService', 'templateService', 'pressReleaseService', 'PressReleaseEditorService')
    }).state('app.prmanager.pressreleasessend', {
        url: '/press-releases/send/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_sender.html',
        ncyBreadcrumb: {
            label: 'content.list.SENDPRESSRELEASE'
        },
        resolve: loadSequence('PressReleaseSenderCtrl', 'PressReleaseSenderService', 'pressReleaseService', 'ContactGroupService')
    }).state('app.prmanager.pressreleasesstats', {
        url: '/press-releases/stats/:id',
        templateUrl: '/bundles/publipr/js/components/PressRelease/press_release_stats.html',
        ncyBreadcrumb: {
            label: 'content.list.PRESSRELEASESTATS'
        },
        resolve: loadSequence('PressReleaseStatsCtrl', 'PressReleaseStatsService', 'pressReleaseService', 'pressReleaseEmailStatsService')
    }).state('app.settings', {
        url: '/settings',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.settings.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.settings.MAIN'
        }
    }).state('app.settings.newsroomtemplates', {
        url: '/newsroom-templates',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_templates.html',
        title: 'content.list.NEWSROOMTEMPLATES',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMTEMPLATES'
        },
        resolve: loadSequence('ngTable', 'NewsroomTemplatesCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesnew', {
        url: '/newsroom-templates/new',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template_form.html',
        title: 'content.list.NEWNEWSROOMTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.NEWNEWSROOMTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomTemplateFormCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesedit', {
        url: '/newsroom-templates/edit/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template_form.html',
        title: 'content.list.EDITNEWSROOMTEMPLATE',
        ncyBreadcrumb: {
            label: 'content.list.EDITNEWSROOMTEMPLATE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'NewsroomTemplateFormCtrl', 'newsroomTemplateService', 'userService')
    }).state('app.settings.newsroomtemplatesdetails', {
        url: '/newsroom-templates/details/:id',
        templateUrl: '/bundles/publipr/js/components/NewsroomTemplate/newsroom_template.html',
        ncyBreadcrumb: {
            label: 'content.list.NEWSROOMTEMPLATEDETAILS'
        },
        resolve: loadSequence('NewsroomTemplateCtrl', 'newsroomTemplateService')
    }).state('app.billing', {
        url: '/billing',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.billing.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.billing.MAIN'
        }
    }).state('app.billing.products', {
        url: '/products',
        templateUrl: '/bundles/publipr/js/components/Product/products.html',
        title: 'content.list.PRODUCTS',
        ncyBreadcrumb: {
            label: 'content.list.PRODUCTS'
        },
        resolve: loadSequence('ngTable', 'ProductsCtrl', 'productService', 'userService')
    }).state('app.billing.productsnew', {
        url: '/products/new',
        templateUrl: '/bundles/publipr/js/components/Product/product_form.html',
        title: 'content.list.NEWPRODUCT',
        ncyBreadcrumb: {
            label: 'content.list.NEWPRODUCT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ProductFormCtrl', 'productService', 'userService')
    }).state('app.billing.productsedit', {
        url: '/products/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Product/product_form.html',
        title: 'content.list.EDITPRODUCT',
        ncyBreadcrumb: {
            label: 'content.list.EDITPRODUCT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'ProductFormCtrl', 'productService', 'userService')
    }).state('app.billing.productsdetails', {
        url: '/products/details/:id',
        templateUrl: '/bundles/publipr/js/components/Product/product.html',
        ncyBreadcrumb: {
            label: 'content.list.PRODUCTDETAILS'
        },
        resolve: loadSequence('ProductCtrl', 'productService')
    }).state('app.billing.payments', {
        url: '/payments',
        templateUrl: '/bundles/publipr/js/components/Payment/payments.html',
        title: 'content.list.PAYMENTS',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTS'
        },
        resolve: loadSequence('ngTable', 'PaymentsCtrl', 'paymentService', 'productService', 'userService')
    }).state('app.billing.paymentsnew', {
        url: '/payments/new',
        templateUrl: '/bundles/publipr/js/components/Payment/payment_form.html',
        title: 'content.list.NEWPAYMENT',
        ncyBreadcrumb: {
            label: 'content.list.NEWPAYMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentFormCtrl', 'paymentService', 'productService', 'userService')
    }).state('app.billing.paymentsedit', {
        url: '/payments/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Payment/payment_form.html',
        title: 'content.list.EDITPAYMENT',
        ncyBreadcrumb: {
            label: 'content.list.EDITPAYMENT'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'PaymentFormCtrl', 'paymentService', 'productService', 'userService')
    }).state('app.billing.paymentsdetails', {
        url: '/payments/details/:id',
        templateUrl: '/bundles/publipr/js/components/Payment/payment.html',
        ncyBreadcrumb: {
            label: 'content.list.PAYMENTDETAILS'
        },
        resolve: loadSequence('PaymentCtrl', 'paymentService')
    }).state('app.billing.check_payment',{
        url: '/purchase',
        templateUrl: '/bundles/publipr/js/components/Payment/purchase.html',
        title: 'content.list.PURCHASE',
        ncyBreadcrumb: {
            label:'content.list.PURCHASE'
        },
        resolve: loadSequence('PurchaseCtrl', 'paymentService', 'PurchaseService')
    }).state('app.billing.purchasenew',{
        url: '/purchase/new',
        templateUrl: '/bundles/publipr/js/components/Payment/purchase_form.html',
        title: 'content.list.PURCHASE',
        ncyBreadcrumb: {
            label:'content.list.PURCHASE'
        },
        resolve: loadSequence('PurchaseFormCtrl', 'paymentService', 'PurchaseService', 'productService')
    }).state('app.billing.invoice', {
        url : '/invoice/:id',
        templateUrl: '/bundles/publipr/js/components/Invoice/invoice.html',
        title: 'content.list.INVOICE',
        ncyBreadcrumb: {
            label:'content.list.INVOICE'
        },
        resolve: loadSequence('InvoiceCtrl', 'paymentService', 'InvoiceDownloadService')
    })
.state('app.accesscontrol', {
        url: '/access-control',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.accesscontrol.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.accesscontrol.MAIN'
        }
    }).state('app.accesscontrol.sessions', {
        url: '/sessions',
        templateUrl: '/bundles/publipr/js/components/Session/sessions.html',
        title: 'content.list.SESSIONS',
        ncyBreadcrumb: {
            label: 'content.list.SESSIONS'
        },
        resolve: loadSequence('ngTable', 'SessionsCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsnew', {
        url: '/sessions/new',
        templateUrl: '/bundles/publipr/js/components/Session/session_form.html',
        title: 'content.list.NEWSESSION',
        ncyBreadcrumb: {
            label: 'content.list.NEWSESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SessionFormCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsedit', {
        url: '/sessions/edit/:id',
        templateUrl: '/bundles/publipr/js/components/Session/session_form.html',
        title: 'content.list.EDITSESSION',
        ncyBreadcrumb: {
            label: 'content.list.EDITSESSION'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'SessionFormCtrl', 'sessionService', 'userService')
    }).state('app.accesscontrol.sessionsdetails', {
        url: '/sessions/details/:id',
        templateUrl: '/bundles/publipr/js/components/Session/session.html',
        ncyBreadcrumb: {
            label: 'content.list.SESSIONDETAILS'
        },
        resolve: loadSequence('SessionCtrl', 'sessionService')
    }).state('app.statistics', {
        url: '/statistics',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'sidebar.nav.statistics.MAIN',
        ncyBreadcrumb: {
            label: 'sidebar.nav.statistics.MAIN'
        }
    }).state('app.statistics.trackpressreleases', {
        url: '/track-press-releases',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_releases.html',
        title: 'content.list.TRACKPRESSRELEASES',
        ncyBreadcrumb: {
            label: 'content.list.TRACKPRESSRELEASES'
        },
        resolve: loadSequence('ngTable', 'TrackPressReleasesCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesnew', {
        url: '/track-press-releases/new',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release_form.html',
        title: 'content.list.NEWTRACKPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.NEWTRACKPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackPressReleaseFormCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesedit', {
        url: '/track-press-releases/edit/:id',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release_form.html',
        title: 'content.list.EDITTRACKPRESSRELEASE',
        ncyBreadcrumb: {
            label: 'content.list.EDITTRACKPRESSRELEASE'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackPressReleaseFormCtrl', 'trackPressReleaseService', 'pressReleaseService', 'userService')
    }).state('app.statistics.trackpressreleasesdetails', {
        url: '/track-press-releases/details/:id',
        templateUrl: '/bundles/publipr/js/components/TrackPressRelease/track_press_release.html',
        ncyBreadcrumb: {
            label: 'content.list.TRACKPRESSRELEASEDETAILS'
        },
        resolve: loadSequence('TrackPressReleaseCtrl', 'trackPressReleaseService')
    }).state('app.statistics.trackemails', {
        url: '/track-emails',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_emails.html',
        title: 'content.list.TRACKEMAILS',
        ncyBreadcrumb: {
            label: 'content.list.TRACKEMAILS'
        },
        resolve: loadSequence('ngTable', 'TrackEmailsCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsnew', {
        url: '/track-emails/new',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email_form.html',
        title: 'content.list.NEWTRACKEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.NEWTRACKEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackEmailFormCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsedit', {
        url: '/track-emails/edit/:id',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email_form.html',
        title: 'content.list.EDITTRACKEMAIL',
        ncyBreadcrumb: {
            label: 'content.list.EDITTRACKEMAIL'
        },
        resolve: loadSequence('ui.select', 'monospaced.elastic', 'touchspin-plugin', 'checklist-model', 'ckeditor-plugin', 'ckeditor', 'TrackEmailFormCtrl', 'trackEmailService', 'emailService', 'userService')
    }).state('app.statistics.trackemailsdetails', {
        url: '/track-emails/details/:id',
        templateUrl: '/bundles/publipr/js/components/TrackEmail/track_email.html',
        ncyBreadcrumb: {
            label: 'content.list.TRACKEMAILDETAILS'
        },
        resolve: loadSequence('TrackEmailCtrl', 'trackEmailService')
    });

}]);
