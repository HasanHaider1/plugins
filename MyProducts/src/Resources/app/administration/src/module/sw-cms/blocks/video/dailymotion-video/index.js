import './component';
import './preview';

const { Application } = Shopware;

Application.getContainer('service').cmsService.registerCmsBlock({
    name: 'dailymotion-video',
    label: 'sw-cms.blocks.video.dailymotionVideo.label',
    category: 'video',
    component: 'sw-cms-block-dailymotion-video',
    previewComponent: 'sw-cms-preview-dailymotion-video',
    defaultConfig: {
        marginBottom: '20px',
        marginTop: '20px',
        marginLeft: '20px',
        marginRight: '20px',
        sizingMode: 'boxed'
    },
    slots: {
        video: 'dailymotion-video'
    }
});