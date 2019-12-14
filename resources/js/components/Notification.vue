 <template>
  <div class="nav-notification">
    <span class="conuter" v-if="hasUnread" >{{ count }}</span>
    <img class="notification-toggle" src="/img/icon-bell.svg" @click="toggleShow">

    <div class="notification-menu" v-if="show" @click.prevent="itemPrevent">
      <div class="panel">
        <div class="panel-heading">
          <strong>Notifications</strong>
        </div>
        <div id="notification-list" class="list-group list-group-alt">
          <notification-item v-for="notification in notifications"
              :key="notification.id"
              :item="notification"
              @read="markAsRead(notification)"
          />
        </div>
        <div class="panel-footer">
          <div v-if="!hasUnread" class="activity">
            <h5 style="padding:10px 0px;">You don't have any unread notifications.</h5>
          </div>
          <a v-if="hasUnread" class="notification-button btn-sep" href="#" @click.prevent="markAllRead">Mark all as read</a>
          <a v-if="hasUnread" class="notification-button btn-sep" href="#" @click.prevent="viewAll">View All</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import NotificationItem from './NotificationItem'

  export default {
    components: { NotificationItem },
    data() {
      return {
        show: false,
        count: 0,
        notifications: [],
      }
    },

    computed: {
      hasUnread: function() {
        return this.count > 0
      }
    },

    mounted () {
      this.registerServiceWorker();
      this.fetch()

      if (window.Echo) {
        this.listen()
      }
      document.body.addEventListener('click', this.handleOutsideClick)
    },

    beforeDestroy () {
      document.body.removeEventListener('click', this.handleOutsideClick)
    },

    methods:{
      registerServiceWorker () {
        if (!('serviceWorker' in navigator)) {
          console.log('Service workers aren\'t supported in this browser.')
          return
        }

        navigator.serviceWorker.register('/sw.js')
          .then(() => this.initialiseServiceWorker())
      },

      initialiseServiceWorker () {
        if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
          console.log('Notifications aren\'t supported.')
          return
        }

        if (Notification.permission === 'denied') {
          console.log('The user has blocked notifications.')
          return
        }

        if (!('PushManager' in window)) {
          console.log('Push messaging isn\'t supported.')
          return
        }

        navigator.serviceWorker.ready.then(registration => {
          registration.pushManager.getSubscription()
          .then(subscription => {
            this.pushButtonDisabled = false

            if (!subscription) {
              this.subscribe();
              return
            }

            this.updateSubscription(subscription)

            this.isPushEnabled = true
          })
          .catch(e => {
            console.log('Error during getSubscription()', e)
          })
        })
      },
      subscribe () {
        navigator.serviceWorker.ready.then(registration => {
          const options = { userVisibleOnly: true }
          const vapidPublicKey = window.Laravel.vapidPublicKey

          if (vapidPublicKey) {
          options.applicationServerKey = this.urlBase64ToUint8Array(vapidPublicKey)
          }

          registration.pushManager.subscribe(options)
          .then(subscription => {
            this.isPushEnabled = true
            this.pushButtonDisabled = false

            this.updateSubscription(subscription)
          })
          .catch(e => {
            if (Notification.permission === 'denied') {
            console.log('Permission for Notifications was denied')
            this.pushButtonDisabled = true
            } else {
            console.log('Unable to subscribe to push.', e)
            this.pushButtonDisabled = false
            }
          })
        })
      },
      updateSubscription (subscription) {
        const key = subscription.getKey('p256dh')
        const token = subscription.getKey('auth')
        const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

        const data = {
          endpoint: subscription.endpoint,
          publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
          authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
          contentEncoding
        }

        this.loading = true

        axios.post('/subscriptions', data)
          .then(() => { this.loading = false })
      },

      /**
       * https://github.com/Minishlink/physbook/blob/02a0d5d7ca0d5d2cc6d308a3a9b81244c63b3f14/app/Resources/public/js/app.js#L177
       *
       * @param  {String} base64String
       * @return {Uint8Array}
       */
      urlBase64ToUint8Array (base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4)
        const base64 = (base64String + padding)
          .replace(/\-/g, '+')
          .replace(/_/g, '/')

        const rawData = window.atob(base64)
        const outputArray = new Uint8Array(rawData.length)

        for (let i = 0; i < rawData.length; ++i) {
          outputArray[i] = rawData.charCodeAt(i)
        }

        return outputArray
      },

      /**
       * Listen for Echo push notifications.
       */
      listen () {
        window.Echo.private(`App.User.${window.Laravel.user.id}`)
          .notification(notification => {
            this.count++
            this.notifications.unshift(notification)
          })
          .listen('NotificationRead', ({ notificationId }) => {
            this.count--

            const index = this.notifications.findIndex(n => n.id === notificationId)
            if (index > -1) {
              this.notifications.splice(index, 1)
            }
          })
          .listen('NotificationReadAll', () => {
            this.count = 0
            this.notifications = []
          })
      },

      handleOutsideClick: function (e) {
        if (this.show) {
          this.show = false;
        }
      },

      toggleShow: function(ev) {
        ev.stopPropagation();
        this.show = !this.show;
      },

      markAsRead ({ id }) {
        const index = this.notifications.findIndex(n => n.id === id);
        if (index > -1) {
          this.count--;
          this.notifications.splice(index, 1);
          axios.patch(`/notifications/${id}/read`)
        }
      },

      itemPrevent: function (ev) {
        ev.stopPropagation();
      },

      markAllRead: function (ev) {
        this.count = 0
        this.notifications = []
        axios.post('/notifications/mark-all-read')
      },

      viewAll: function (ev) {
        ev.stopPropagation();
        this.fetch(null);
      },

      fetch (limit = 5) {
        axios.get('/notifications', { params: { limit } })
          .then(({ data: { count, notifications } }) => {
            this.count = count;
            this.notifications = notifications.map(({ id, data, created }) => {
              return {
                id: id,
                title: data.title,
                body: data.body,
                created: created
              }
            })
          })
      },
    },
  }
</script>
<style>

  .nav-notification {
  position: relative;
  font-family: 'Open Sans', Helvetica Neue, Helvetica, Arial;
  }

  .nav-notification .conuter {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background-color: #fb6b5b;
    color: white;
    display: flex;
    align-items: center;
    font-size: 12px;
    justify-content: center;
  }

  .notification-menu {
    position: absolute;
    top: 100%;
    right: 0;
    left: auto;
    z-index: 1000;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
  }

  #notification-list {
    width: 350px;
    max-height: 450px;
    overflow-y: scroll;
  }

  .notification-menu > .panel {
    border: none;
    margin: -5px 0;
  }

  .panel-heading {
    background-color: #f1f1f1;
    color: #002b63a3;
    border-bottom: 1px solid #dedede;
    font-size: 18px;
    padding: 10px 15px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
  }

  .activity-item i {
    float: left;
    margin-top: 3px;
    font-size: 16px;
  }

  .activity-item {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid rgba(0,0,0,0.15);
  }

  div.activity {
    margin-left: 28px;
    margin: 0px;
    padding: 5px 12px;
  }

  div.activity h6 {
    display: inline;
    margin: 0px;
  }
  div.activity p {
    margin: 5px;
    line-height: 15px;
    font-size: 12px;
  }

  .activity-item .actions-container {
    padding-right: 10px;
  }

  .activity-item .actions-container .btn-read {
    cursor: pointer;
  }

  #notification-list div.activity-item a {
    font-weight: 600;
  }

  div.activity span {
    display: block;
    color: #999;
    font-size: 11px;
    line-height: 16px;
  }

  #notifications i.fa {
    font-size: 17px;
  }

  .noty_type_error * {
    font-weight: normal !important;
  }

  .noty_type_error a {
    font-weight: bold !important;
  }

  .noty_bar.noty_type_error a, .noty_bar.noty_type_error i {
    color: #fff
  }

  .noty_bar.noty_type_information a {
    color: #fff;
    font-weight: bold;
  }

  .noty_type_error div.activity span
  {
    color: #fff
  }

  .noty_type_information div.activity span
  {
    color: #fefefe
  }

  .no-notification {
    padding: 10px 5px;
    text-align: center;
  }


  .noty-manager-wrapper {
    position: relative;
    display: inline-block !important;
  }

  .noty-manager-bubble
  {
    position: absolute;
    top: -8px;
    background-color: #fb6b5b;
    color: #fff;
    padding: 2px 5px !important;
    font-size: 9px;
    line-height: 12px;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    cursor: pointer;
    height: 15px;
    font-weight: bold;

    border-radius: 2px;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    box-shadow:1px 1px 1px rgba(0,0,0,.1);
    opacity: 0;
  }

  .notification-toggle {
    cursor: pointer;
    color:red;
  }

  .notification-button {
    background: linear-gradient(135deg,#283f5c 0%,#8e9385 100%) !important;
    color: #fff !important;
    border: none;
    font-size: inherit;
    color: inherit;
    background: none;
    cursor: pointer;
    display: inline-block;
    margin: 15px 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    outline: none;
    position: relative;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
  }

  .notification-button:after {
    content: '';
    position: absolute;
    z-index: -1;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
  }

  .notification-button:before {
    font-family: 'FontAwesome';
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    position: relative;
    -webkit-font-smoothing: antialiased;
    position: absolute;
    height: 100%;
    left: 0;
    top: 0;
    line-height: 3;
    font-size: 140%;
    width: 60px;
  }

  .notification-button:hover {
    background: linear-gradient(135deg,#34495e 0%,#8e9385 100%) !important;
  }

  .notification-button:active {
    background: linear-gradient(135deg,#2c3e50 0%,#8e9385 100%) !important;
    top: 2px;
  }

  .btn-sep {
    width: 45%;
    padding: 10px;
    margin: 5px;
    border-radius: 5px;
    text-align: center;
    line-height: 20px;
    text-transform: inherit;
  }

  .panel-footer {
    display: flex;
    justify-content: space-between;
    padding: 5px;
  }

  .btn-sep:before {
    background: rgba(0,0,0,0.15);
  }
</style>
