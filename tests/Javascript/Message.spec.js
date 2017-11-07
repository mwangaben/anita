import {
    mount
} from 'vue-test-utils';
import Message from '../../resources/assets/js/components/Message.vue';
import MessageList from '../../resources/assets/js/components/MessageList.vue';
import expect from 'expect';
import jest from 'jest-mock';
describe('Message', () => {
    let wrapper;
    beforeEach(() => {
        wrapper = mount(Message);
        wrapper.setProps({
            message: 'hello'
        });
    })
    it('calls handleClick when click on message', () => {
        let spy = jest.spyOn(wrapper.vm, 'handleClick');
        wrapper.update();
        wrapper.find('.message').trigger('click');
        expect(wrapper.vm.handleClick).toBeCalled()
    });
    it('calls handleClick when click on message this is via jest mocking', () => {
        wrapper.vm.handleClick = jest.fn();
        wrapper.update()
        wrapper.find('.message').trigger('click');
        expect(wrapper.vm.handleClick).toBeCalled();
    });
    // the recommend way of testing if method is being called
    it('calls handleClick when click on message this is  via vue setMethods', () => {
        const stub = jest.fn();
        wrapper.setMethods({
            handleClick: stub
        });
        wrapper.find('.message').trigger('click');
        expect(stub).toBeCalled();
    });
    it('it checks if the handleClick() emit messageClicked event when is clicked', () => {
        // wrapper.find('.message').trigger('click');
        wrapper.vm.handleClick();
        expect(wrapper.emitted().messageClicked).toBeTruthy();
    });
    it('it checks if the handleClick() emit message_clicked event when is clicked using jest', () => {
        const stub = jest.fn();
        wrapper.vm.$on('messageClicked', stub);
        wrapper.vm.handleClick();
        expect(stub).toBeCalledWith('hello');
    });
     
});