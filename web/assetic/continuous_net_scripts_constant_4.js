app.constant('APP_JS_REQUIRES', {
    //*** Scripts
    scripts: {
        //*** Controllers
        'LoginCtrl': '/bundles/publipr/js/components/Auth/LoginCtrl.js',
        'LockScreenCtrl': '/bundles/publipr/js/components/Auth/LockScreenCtrl.js',
        'RegisterCtrl': '/bundles/publipr/js/components/Auth/RegisterCtrl.js',
        'EmailConfirmCtrl': '/bundles/publipr/js/components/Auth/EmailConfirmCtrl.js',
        'ResetPasswordCtrl': '/bundles/publipr/js/components/Auth/ResetPasswordCtrl.js',
        'ResetCtrl': '/bundles/publipr/js/components/Auth/ResetCtrl.js',
        'ChangePasswordCtrl': '/bundles/publipr/js/components/Auth/ChangePasswordCtrl.js',
        'ProfileCtrl': '/bundles/publipr/js/components/Auth/ProfileCtrl.js',
        'DashboardCtrl': '/bundles/publipr/js/components/Main/DashboardCtrl.js',
        'CompaniesCtrl': '/bundles/publipr/js/components/Company/CompaniesCtrl.js',
        'CompanyFormCtrl': '/bundles/publipr/js/components/Company/CompanyFormCtrl.js',
        'CompanyCtrl': '/bundles/publipr/js/components/Company/CompanyCtrl.js',
        'ContactsCtrl': '/bundles/publipr/js/components/Contact/ContactsCtrl.js',
        'ContactFormCtrl': '/bundles/publipr/js/components/Contact/ContactFormCtrl.js',
        'ContactCtrl': '/bundles/publipr/js/components/Contact/ContactCtrl.js',
        'ContactImportCtrl': '/bundles/publipr/js/components/Contact/ContactImportCtrl.js',
        'ContactExportCtrl': '/bundles/publipr/js/components/Contact/ContactExportCtrl.js',
        'ContactGroupsCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupsCtrl.js',
        'ContactGroupFormCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupFormCtrl.js',
        'ContactGroupCtrl': '/bundles/publipr/js/components/ContactGroup/ContactGroupCtrl.js',
        'ContentBlocksCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlocksCtrl.js',
        'ContentBlockFormCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlockFormCtrl.js',
        'ContentBlockCtrl': '/bundles/publipr/js/components/ContentBlock/ContentBlockCtrl.js',
        'CountriesCtrl': '/bundles/publipr/js/components/Country/CountriesCtrl.js',
        'CountryFormCtrl': '/bundles/publipr/js/components/Country/CountryFormCtrl.js',
        'CountryCtrl': '/bundles/publipr/js/components/Country/CountryCtrl.js',
        'EmailsCtrl': '/bundles/publipr/js/components/Email/EmailsCtrl.js',
        'EmailFormCtrl': '/bundles/publipr/js/components/Email/EmailFormCtrl.js',
        'EmailCtrl': '/bundles/publipr/js/components/Email/EmailCtrl.js',
        'EmailCampaignsCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignsCtrl.js',
        'EmailCampaignFormCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignFormCtrl.js',
        'EmailCampaignCtrl': '/bundles/publipr/js/components/EmailCampaign/EmailCampaignCtrl.js',
        'EmailTemplatesCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplatesCtrl.js',
        'EmailTemplateFormCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplateFormCtrl.js',
        'EmailTemplateCtrl': '/bundles/publipr/js/components/EmailTemplate/EmailTemplateCtrl.js',
        'FontsCtrl': '/bundles/publipr/js/components/Font/FontsCtrl.js',
        'FontFormCtrl': '/bundles/publipr/js/components/Font/FontFormCtrl.js',
        'FontCtrl': '/bundles/publipr/js/components/Font/FontCtrl.js',
        'LanguagesCtrl': '/bundles/publipr/js/components/Language/LanguagesCtrl.js',
        'LanguageFormCtrl': '/bundles/publipr/js/components/Language/LanguageFormCtrl.js',
        'LanguageCtrl': '/bundles/publipr/js/components/Language/LanguageCtrl.js',
        'LayoutsCtrl': '/bundles/publipr/js/components/Layout/LayoutsCtrl.js',
        'LayoutFormCtrl': '/bundles/publipr/js/components/Layout/LayoutFormCtrl.js',
        'LayoutCtrl': '/bundles/publipr/js/components/Layout/LayoutCtrl.js',
        'LogsCtrl': '/bundles/publipr/js/components/Log/LogsCtrl.js',
        'LogFormCtrl': '/bundles/publipr/js/components/Log/LogFormCtrl.js',
        'LogCtrl': '/bundles/publipr/js/components/Log/LogCtrl.js',
        'NewsroomsCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomsCtrl.js',
        'NewsroomFormCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomFormCtrl.js',
        'NewsroomCtrl': '/bundles/publipr/js/components/Newsroom/NewsroomCtrl.js',
        'NewsroomTemplatesCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplatesCtrl.js',
        'NewsroomTemplateFormCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateFormCtrl.js',
        'NewsroomTemplateCtrl': '/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateCtrl.js',
        'UsersCtrl': '/bundles/publipr/js/components/User/UsersCtrl.js',
        'UserFormCtrl': '/bundles/publipr/js/components/User/UserFormCtrl.js',
        'UserCtrl': '/bundles/publipr/js/components/User/UserCtrl.js',
        'PaymentsCtrl': '/bundles/publipr/js/components/Payment/PaymentsCtrl.js',
        'PaymentFormCtrl': '/bundles/publipr/js/components/Payment/PaymentFormCtrl.js',
        'PaymentCtrl': '/bundles/publipr/js/components/Payment/PaymentCtrl.js',
        'PurchaseCtrl': '/bundles/publipr/js/components/Payment/PurchaseCtrl.js',
        'PurchaseFormCtrl': '/bundles/publipr/js/components/Payment/PurchaseFormCtrl.js',
        'InvoiceCtrl': '/bundles/publipr/js/components/Invoice/InvoiceCtrl.js',
        'PaymentPlansCtrl': '/bundles/publipr/js/components/PaymentPlan/PaymentPlansCtrl.js',
        'PaymentPlanFormCtrl': '/bundles/publipr/js/components/PaymentPlan/PaymentPlanFormCtrl.js',
        'PaymentPlanCtrl': '/bundles/publipr/js/components/PaymentPlan/PaymentPlanCtrl.js',
        'PressReleasesCtrl': '/bundles/publipr/js/components/PressRelease/PressReleasesCtrl.js',
        'PressReleaseFormCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseFormCtrl.js',
        'PressReleaseCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseCtrl.js',
        'PressReleaseSenderCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseSenderCtrl.js',
        'PressReleaseStatsCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseStatsCtrl.js',
        'PressReleaseEditorCtrl': '/bundles/publipr/js/components/PressRelease/PressReleaseEditorCtrl.js',
        'ProductsCtrl': '/bundles/publipr/js/components/Product/ProductsCtrl.js',
        'ProductFormCtrl': '/bundles/publipr/js/components/Product/ProductFormCtrl.js',
        'ProductCtrl': '/bundles/publipr/js/components/Product/ProductCtrl.js',
        'SessionsCtrl': '/bundles/publipr/js/components/Session/SessionsCtrl.js',
        'SessionFormCtrl': '/bundles/publipr/js/components/Session/SessionFormCtrl.js',
        'SessionCtrl': '/bundles/publipr/js/components/Session/SessionCtrl.js',
        'SettingsCtrl': '/bundles/publipr/js/components/Setting/SettingsCtrl.js',
        'SettingFormCtrl': '/bundles/publipr/js/components/Setting/SettingFormCtrl.js',
        'SettingCtrl': '/bundles/publipr/js/components/Setting/SettingCtrl.js',
        'TemplatesCtrl': '/bundles/publipr/js/components/Template/TemplatesCtrl.js',
        'TemplateFormCtrl': '/bundles/publipr/js/components/Template/TemplateFormCtrl.js',
        'TemplateCtrl': '/bundles/publipr/js/components/Template/TemplateCtrl.js',
        'TrackEmailsCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailsCtrl.js',
        'TrackEmailFormCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailFormCtrl.js',
        'TrackEmailCtrl': '/bundles/publipr/js/components/TrackEmail/TrackEmailCtrl.js',
        'TrackPressReleasesCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleasesCtrl.js',
        'TrackPressReleaseFormCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseFormCtrl.js',
        'TrackPressReleaseCtrl': '/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseCtrl.js',
        'UserPaymentPlansCtrl': '/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlansCtrl.js',
        'UserPaymentPlanFormCtrl': '/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlanFormCtrl.js',
        'UserPaymentPlanCtrl': '/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlanCtrl.js',
        'recurrentCtrl': '/bundles/publipr/js/components/Payment/recurrentCtrl.js',
    },
    modules: [{
        name: 'LoginService',
        files: ['/bundles/publipr/js/components/Auth/LoginService.js']
    },{
        name: 'RegisterService',
        files: ['/bundles/publipr/js/components/Auth/RegisterService.js']
    },{
        name: 'ResetPasswordService',
        files: ['/bundles/publipr/js/components/Auth/ResetPasswordService.js']
    },{
        name: 'ProfileService',
        files: ['/bundles/publipr/js/components/Auth/ProfileService.js']
    },{
        name: 'DashboardService',
        files: ['/bundles/publipr/js/components/Main/DashboardService.js']
    },{
        name: 'companyService',
        files: ['/bundles/publipr/js/components/Company/CompanyService.js']
    },{
        name: 'contactService',
        files: ['/bundles/publipr/js/components/Contact/ContactService.js']
    },{
        name: 'ContactImportService',
        files: ['/bundles/publipr/js/components/Contact/ContactImportService.js']
    },{
        name: 'ContactExportService',
        files: ['/bundles/publipr/js/components/Contact/ContactExportService.js']
    },{
        name: 'contactGroupService',
        files: ['/bundles/publipr/js/components/ContactGroup/ContactGroupService.js']
    },{
        name: 'contentBlockService',
        files: ['/bundles/publipr/js/components/ContentBlock/ContentBlockService.js']
    },{
        name: 'countryService',
        files: ['/bundles/publipr/js/components/Country/CountryService.js']
    },{
        name: 'emailService',
        files: ['/bundles/publipr/js/components/Email/EmailService.js']
    },{
        name: 'emailCampaignService',
        files: ['/bundles/publipr/js/components/EmailCampaign/EmailCampaignService.js']
    },{
        name: 'emailTemplateService',
        files: ['/bundles/publipr/js/components/EmailTemplate/EmailTemplateService.js']
    },{
        name: 'fontService',
        files: ['/bundles/publipr/js/components/Font/FontService.js']
    },{
        name: 'languageService',
        files: ['/bundles/publipr/js/components/Language/LanguageService.js']
    },{
        name: 'layoutService',
        files: ['/bundles/publipr/js/components/Layout/LayoutService.js']
    },{
        name: 'logService',
        files: ['/bundles/publipr/js/components/Log/LogService.js']
    },{
        name: 'newsroomService',
        files: ['/bundles/publipr/js/components/Newsroom/NewsroomService.js']
    },{
        name: 'newsroomTemplateService',
        files: ['/bundles/publipr/js/components/NewsroomTemplate/NewsroomTemplateService.js']
    },{
        name: 'userService',
        files: ['/bundles/publipr/js/components/User/UserService.js']
    },{
        name: 'paymentService',
        files: ['/bundles/publipr/js/components/Payment/PaymentService.js']
    },{
        name: 'PurchaseService',
        files: ['/bundles/publipr/js/components/Payment/PurchaseService.js']
    },{
        name: 'InvoiceService',
        files: ['/bundles/publipr/js/components/Invoice/InvoiceService.js']
    },{
        name: 'InvoiceDownloadService',
        files: ['/bundles/publipr/js/components/Invoice/InvoiceDownloadService.js']
    },{
        name: 'paymentPlanService',
        files: ['/bundles/publipr/js/components/PaymentPlan/PaymentPlanService.js']
    },{
        name: 'pressReleaseService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseService.js']
    },{
        name: 'PressReleaseEditorService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseEditorService.js']
    },{
        name: 'PressReleaseEmailStatsService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseEmailStatsService.js']
    },{
        name: 'PressReleaseSenderService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseSenderService.js']
    },{
        name: 'PressReleaseStatsService',
        files: ['/bundles/publipr/js/components/PressRelease/PressReleaseStatsService.js']
    },{
        name: 'productService',
        files: ['/bundles/publipr/js/components/Product/ProductService.js']
    },{
        name: 'sessionService',
        files: ['/bundles/publipr/js/components/Session/SessionService.js']
    },{
        name: 'settingService',
        files: ['/bundles/publipr/js/components/Setting/SettingService.js']
    },{
        name: 'templateService',
        files: ['/bundles/publipr/js/components/Template/TemplateService.js']
    },{
        name: 'trackEmailService',
        files: ['/bundles/publipr/js/components/TrackEmail/TrackEmailService.js']
    },{
        name: 'trackPressReleaseService',
        files: ['/bundles/publipr/js/components/TrackPressRelease/TrackPressReleaseService.js']
    },{
        name: 'userPaymentPlanService',
        files: ['/bundles/publipr/js/components/UserPaymentPlan/UserPaymentPlanService.js']
    }]
});
