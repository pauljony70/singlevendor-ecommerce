(function ($) {
  ("use strict");
  // Preloader
  $(".preloader").delay(1600).fadeOut("slow");

  // Sticky Menu
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 10) {
      $(".header-menu-area").addClass("sticky");
    } else {
      $(".header-menu-area").removeClass("sticky");
    }
  });

  // Mobile menu
  $(".hamburger").on("click", function (event) {
    $(this).toggleClass("h-active");
    $(".main-nav").toggleClass("slidenav");
  });

  $(".header-home .main-nav ul li  a").on("click", function (event) {
    $(".hamburger").removeClass("h-active");
    $(".main-nav").removeClass("slidenav");
  });

  $(".main-nav .fl").on("click", function (event) {
    var $fl = $(this);
    $(this).parent().siblings().find(".sub-menu").slideUp();
    $(this).parent().siblings().find(".fl").addClass("flaticon-plus").text("+");
    if ($fl.hasClass("flaticon-plus")) {
      $fl.removeClass("flaticon-plus").addClass("flaticon-minus").text("-");
    } else {
      $fl.removeClass("flaticon-minus").addClass("flaticon-plus").text("+");
    }
    $fl.next(".sub-menu").slideToggle();
  });

  // Magnific Popup gallery

  $(".single-sidebar-gallery").magnificPopup({
    delegate: "a", // child items selector, by clicking on it popup will open

    gallery: {
      enabled: true,
    },

    type: "image",

    // other options
  });

  // Slick slide Home Three Hero
  $(".home-three-hero-slide-img-wrap").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
    fade: true,
    arrows: false,
    dots: false,
    asNavFor: ".home-three-hero-slide-content-wrap",
  });
  $(".home-three-hero-slide-content-wrap").slick({
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    prevArrow: "<i class='bx bxs-chevron-left'></i>",
    nextArrow: "<i class='bx bxs-chevron-right' ></i>",
    asNavFor: ".home-three-hero-slide-img-wrap",
  });
  
  
  // category 
  
  
  $(".category_sliders").owlCarousel({
    items: 9,
    loop: true,
    smartSpeed: 1000,
    autoplay: true,
    dots: false,
    margin: 24,
    nav: true,
    navText: [
      "<i class='fas fa-chevron-left'></i>",
      "<i class='fas fa-chevron-right'></i>",
    ],
    responsive: {
      0: {
        items: 2,
      },
      480: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 7,
      },
      1400: {
        items: 9,
      },
    },
  }); 
      

  // Owl Carousel Home Three Blog

  $(".bolo-wrap-slide").owlCarousel({
    items: 6,

    loop: true,

    smartSpeed: 1500,

    autoplay: false,

    dots: true,

    margin: 24,

    nav: false,

    navText: [
      "<i class='fas fa-chevron-left'></i>",

      "<i class='fas fa-chevron-right'></i>",
    ],

    responsive: {
      0: {
        items: 2,
      },

      480: {
        items: 2,
      },

      768: {
        items: 4,
      },

      992: {
        items: 4,
      },

      1200: {
        items: 6,
      },

      1400: {
        items: 6,
      },
    },
  });

  // Owl Carousel Home Two New Arrival

  $(".single-home-two-arrival-slide").owlCarousel({
    items: 6,

    loop: true,

    smartSpeed: 1500,

    autoplay: false,

    dots: true,

    margin: 24,

    nav: false,

    navText: [
      "<i class='fas fa-chevron-left'></i>",

      "<i class='fas fa-chevron-right'></i>",
    ],

    responsive: {
      0: {
        items: 2,
      },

      480: {
        items: 2,
      },

      768: {
        items: 4,
      },

      992: {
        items: 4,
      },

      1200: {
        items: 6,
      },

      1400: {
        items: 6,
      },
    },
  });

  // Owl Carousel Home Two Hero

  $(".home-two-hero-slide-wrap").owlCarousel({
    items: 1,

    loop: true,

    smartSpeed: 1500,

    autoplay: false,

    dots: false,

    nav: true,

    // animateOut: 'fadeOut',

    navText: [
      "<i class='bi bi-arrow-left'></i>",

      "<i class='bi bi-arrow-right'></i>",
    ],

    responsive: {
      0: {
        items: 1,
      },

      480: {
        items: 1,
      },

      768: {
        items: 1,
      },

      992: {
        items: 1,
      },

      1200: {
        items: 1,
      },

      1400: {
        items: 1,
      },
    },
  });

  // Owl Carousel Home One Favorite

  $(".single-home-one-favorite-slide").owlCarousel({
    items: 6,
    loop: true,
    smartSpeed: 1000,
    autoplay: true,
    dots: false,
    margin: 24,
    nav: true,
    navText: [
      "<i class='bx bx-chevron-left bx-md'></i>",
      "<i class='bx bx-chevron-right bx-md'></i>",
    ],
    responsive: {
      0: {
        items: 2,
      },
      480: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 6,
      },
      1400: {
        items: 6,
      },
    },
  });

  // Owl Carousel Home One Testimonial

  $(".testimonial-wrap").owlCarousel({
    items: 1,

    loop: true,

    smartSpeed: 1500,

    autoplay: false,

    dots: true,

    margin: 24,

    nav: true,

    navText: [
      "<i class='fas fa-chevron-left'></i>",

      "<i class='fas fa-chevron-right'></i>",
    ],

    responsive: {
      0: {
        items: 1,

        autoplay: true,
      },

      480: {
        items: 1,

        autoplay: true,
      },

      768: {
        items: 1,

        autoplay: true,
      },

      992: {
        items: 1,

        autoplay: true,
      },

      1200: {
        items: 1,
      },

      1400: {
        items: 1,
      },
    },
  });

  // Newsletter Popup
  if ($.cookie("PouUp")) {
    $("#nlmOverlay").hide();
    $("#nlmPopup").hide();
  } else {
    $("#nlmOverlay").delay(3800).fadeIn(400);
    $("#nlmPopup").delay(4000).fadeIn(400);
  }

  $("#btnClose").on("click", function (e) {
    HideDialog();
    SetCookie();
    e.preventDefault();
  });

  function SetCookie() {
    $.cookie("PouUp", "Close", {
      expires: 7,
    });
  }

  function HideDialog() {
    $("#nlmOverlay").fadeOut(400);
    $("#nlmPopup").fadeOut(300);
  }
  // Newsletter Popup End

  // Shope Two Price Range

  (function ($) {
    "use strict";

    var DEBUG = false, // make true to enable debug output
      PLUGIN_IDENTIFIER = "RangeSlider";

    var RangeSlider = function (element, options) {
      this.element = element;

      this.options = options || {};

      this.defaults = {
        output: {
          prefix: "", // function or string

          suffix: "", // function or string

          format: function (output) {
            return output;
          },
        },

        change: function (event, obj) {},
      };

      // This next line takes advantage of HTML5 data attributes

      // to support customization of the plugin on a per-element

      // basis.

      this.metadata = $(this.element).data("options");
    };

    RangeSlider.prototype = {
      ////////////////////////////////////////////////////

      // Initializers

      ////////////////////////////////////////////////////

      init: function () {
        if (DEBUG && console) console.log("RangeSlider init");

        this.config = $.extend(
          true,

          {},

          this.defaults,

          this.options,

          this.metadata
        );

        var self = this;

        // Add the markup for the slider track

        this.trackFull = $('<div class="track track--full"></div>').appendTo(
          self.element
        );

        this.trackIncluded = $(
          '<div class="track track--included"></div>'
        ).appendTo(self.element);

        this.inputs = [];

        $('input[type="range"]', this.element).each(function (index, value) {
          var rangeInput = this;

          // Add the ouput markup to the page.

          rangeInput.output = $("<output>").appendTo(self.element);

          // Get the current z-index of the output for later use

          rangeInput.output.zindex =
            parseInt($(rangeInput.output).css("z-index")) || 1;

          // Add the thumb markup to the page.

          rangeInput.thumb = $('<div class="slider-thumb">').prependTo(
            self.element
          );

          // Store the initial val, incase we need to reset.

          rangeInput.initialValue = $(this).val();

          // Method to update the slider output text/position

          rangeInput.update = function () {
            if (DEBUG && console) console.log("RangeSlider rangeInput.update");

            var range = $(this).attr("max") - $(this).attr("min"),
              offset = $(this).val() - $(this).attr("min"),
              pos = (offset / range) * 100 + "%",
              transPos = (offset / range) * -100 + "%",
              prefix =
                typeof self.config.output.prefix == "function"
                  ? self.config.output.prefix.call(self, rangeInput)
                  : self.config.output.prefix,
              format = self.config.output.format($(rangeInput).val()),
              suffix =
                typeof self.config.output.suffix == "function"
                  ? self.config.output.suffix.call(self, rangeInput)
                  : self.config.output.suffix;

            // Update the HTML

            $(rangeInput.output).html(prefix + "" + format + "" + suffix);

            $(rangeInput.output).css("left", pos);

            $(rangeInput.output).css(
              "transform",

              "translate(" + transPos + ",0)"
            );

            // Update the IE hack thumbs

            $(rangeInput.thumb).css("left", pos);

            $(rangeInput.thumb).css(
              "transform",

              "translate(" + transPos + ",0)"
            );

            // Adjust the track for the inputs

            self.adjustTrack();
          };

          // Send the current ouput to the front for better stacking

          rangeInput.sendOutputToFront = function () {
            $(this.output).css("z-index", rangeInput.output.zindex + 1);
          };

          // Send the current ouput to the back behind the other

          rangeInput.sendOutputToBack = function () {
            $(this.output).css("z-index", rangeInput.output.zindex);
          };

          ///////////////////////////////////////////////////

          // IE hack because pointer-events:none doesn't pass the

          // event to the slider thumb, so we have to make our own.

          ///////////////////////////////////////////////////

          $(rangeInput.thumb).on("mousedown", function (event) {
            // Send all output to the back

            self.sendAllOutputToBack();

            // Send this output to the front

            rangeInput.sendOutputToFront();

            // Turn mouse tracking on

            $(this).data("tracking", true);

            $(document).one("mouseup", function () {
              // Turn mouse tracking off

              $(rangeInput.thumb).data("tracking", false);

              // Trigger the change event

              self.change(event);
            });
          });

          // IE hack - track the mouse move within the input range

          $("body").on("mousemove", function (event) {
            // If we're tracking the mouse move

            if ($(rangeInput.thumb).data("tracking")) {
              var rangeOffset = $(rangeInput).offset(),
                relX = event.pageX - rangeOffset.left,
                rangeWidth = $(rangeInput).width();

              // If the mouse move is within the input area

              // update the slider with the correct value

              if (relX <= rangeWidth) {
                var val = relX / rangeWidth;

                $(rangeInput).val(val * $(rangeInput).attr("max"));

                rangeInput.update();
              }
            }
          });

          // Update the output text on slider change

          $(this).on("mousedown input change touchstart", function (event) {
            if (DEBUG && console)
              console.log("RangeSlider rangeInput, mousedown input touchstart");

            // Send all output to the back

            self.sendAllOutputToBack();

            // Send this output to the front

            rangeInput.sendOutputToFront();

            // Update the output

            rangeInput.update();
          });

          // Fire the onchange event

          $(this).on("mouseup touchend", function (event) {
            if (DEBUG && console) console.log("RangeSlider rangeInput, change");

            self.change(event);
          });

          // Add this input to the inputs array for use later

          self.inputs.push(this);
        });

        // Reset to set to initial values

        this.reset();

        // Return the instance

        return this;
      },

      sendAllOutputToBack: function () {
        $.map(this.inputs, function (input, index) {
          input.sendOutputToBack();
        });
      },

      change: function (event) {
        if (DEBUG && console) console.log("RangeSlider change", event);

        // Get the values of each input

        var values = $.map(this.inputs, function (input, index) {
          return {
            value: parseInt($(input).val()),

            min: parseInt($(input).attr("min")),

            max: parseInt($(input).attr("max")),
          };
        });

        // Sort the array by value, if we have 2 or more sliders

        values.sort(function (a, b) {
          return a.value - b.value;
        });

        // call the on change function in the context of the rangeslider and pass the values

        this.config.change.call(this, event, values);
      },

      reset: function () {
        if (DEBUG && console) console.log("RangeSlider reset");

        $.map(this.inputs, function (input, index) {
          $(input).val(input.initialValue);

          input.update();
        });
      },

      adjustTrack: function () {
        if (DEBUG && console) console.log("RangeSlider adjustTrack");

        var valueMin = Infinity,
          rangeMin = Infinity,
          valueMax = 0,
          rangeMax = 0;

        // Loop through all input to get min and max

        $.map(this.inputs, function (input, index) {
          var val = parseInt($(input).val()),
            min = parseInt($(input).attr("min")),
            max = parseInt($(input).attr("max"));

          // Get the min and max values of the inputs

          valueMin = val < valueMin ? val : valueMin;

          valueMax = val > valueMax ? val : valueMax;

          // Get the min and max possible values

          rangeMin = min < rangeMin ? min : rangeMin;

          rangeMax = max > rangeMax ? max : rangeMax;
        });

        // Get the difference if there are 2 range input, use max for one input.

        // Sets left to 0 for one input and adjust for 2 inputs

        if (this.inputs.length > 1) {
          this.trackIncluded.css(
            "width",

            ((valueMax - valueMin) / (rangeMax - rangeMin)) * 100 + "%"
          );

          this.trackIncluded.css(
            "left",

            ((valueMin - rangeMin) / (rangeMax - rangeMin)) * 100 + "%"
          );
        } else {
          this.trackIncluded.css(
            "width",

            (valueMax / (rangeMax - rangeMin)) * 100 + "%"
          );

          this.trackIncluded.css("left", "0%");
        }
      },
    };

    RangeSlider.defaults = RangeSlider.prototype.defaults;

    $.fn.RangeSlider = function (options) {
      if (DEBUG && console) console.log("$.fn.RangeSlider", options);

      return this.each(function () {
        var instance = $(this).data(PLUGIN_IDENTIFIER);

        if (!instance) {
          instance = new RangeSlider(this, options).init();

          $(this).data(PLUGIN_IDENTIFIER, instance);
        }
      });
    };
  })(jQuery);

  var rangeSlider = $("#facet-price-range-slider");

  if (rangeSlider.length > 0) {
    rangeSlider.RangeSlider({
      output: {
        format: function (output) {
          return output.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        },

        suffix: function (input) {
          return parseInt($(input).val()) == parseInt($(input).attr("max"))
            ? this.config.maxSymbol
            : "";
        },
      },
    });
  }

  // Shope Two Price Range End

  // Cart Change Shipping Address

  var catDropdown = document.querySelectorAll(".click-address-here");

  var catCard = document.querySelectorAll(".cart-address-change-wrap");

  catDropdown.forEach((element) => {
    element.addEventListener("click", () => {
      element.nextElementSibling.classList.toggle("short-cart-active");
    });
  });

  // Cart Change Shipping Address  End

  // Magnific Popup Shop Details Expand

  $(".popup-gallery").magnificPopup({
    delegate: "a", // child items selector, by clicking on it popup will open

    gallery: {
      enabled: true,
    },

    type: "image",

    // other options
  });

  // Magnific Popup Shop Details Expand End

  // Quantity Number add button

  function wcqib_refresh_quantity_increments() {
    jQuery(
      "div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)"
    ).each(function (a, b) {
      var c = jQuery(b);

      c.addClass("buttons_added"),
        c
          .children()

          .first()

          .before('<input type="button" value="-" class="minus" />'),
        c

          .children()

          .last()

          .after('<input type="button" value="+" class="plus" />');
    });
  }

  String.prototype.getDecimals ||
    (String.prototype.getDecimals = function () {
      var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);

      return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0;
    }),
    jQuery(document).ready(function () {
      wcqib_refresh_quantity_increments();
    }),
    jQuery(document).on("updated_wc_div", function () {
      wcqib_refresh_quantity_increments();
    }),
    jQuery(document).on("click", ".plus, .minus", function () {
      var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");

      (b && "" !== b && "NaN" !== b) || (b = 0),
        ("" !== c && "NaN" !== c) || (c = ""),
        ("" !== d && "NaN" !== d) || (d = 0),
        ("any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e)) ||
          (e = 1),
        jQuery(this).is(".plus")
          ? c && b >= c
            ? a.val(c)
            : a.val((b + parseFloat(e)).toFixed(e.getDecimals()))
          : d && b <= d
          ? a.val(d)
          : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())),
        a.trigger("change");
    });

  // Quantity Number add button End

  // flash Light

  document.querySelectorAll(".fl-switch").forEach((element) => {
    element.addEventListener("click", () => {
      document.querySelectorAll(".flash-light-box-wrap").forEach((el) => {
        el.classList.toggle("light-active");
      });
    });
  });

  // flash Light End

  // Contact Form

  // Get the form.

  var form = $("#contact-form");

  // Get the messages div.

  var formMessages = $(".form-message");

  // Set up an event listener for the contact form.

  $(form).on("submit", function (e) {
    // Stop the browser from submitting the form.

    e.preventDefault();

    // Serialize the form data.

    var formData = $(form).serialize();

    // Submit the form using AJAX.

    $.ajax({
      type: "POST",

      url: $(form).attr("action"),

      data: formData,
    })

      .done(function (response) {
        // Make sure that the formMessages div has the 'success' class.

        $(formMessages).removeClass("error");

        $(formMessages).addClass("success");

        // Set the message text.

        $(formMessages).text(response);

        // Clear the form.

        $("#contact-form input,#contact-form textarea").val("");
      })

      .fail(function (data) {
        // Make sure that the formMessages div has the 'error' class.

        $(formMessages).removeClass("success");

        $(formMessages).addClass("error");

        // Set the message text.

        if (data.responseText !== "") {
          $(formMessages).text(data.responseText);
        } else {
          $(formMessages).text(
            "Oops! An error occured. Message could not be sent."
          );
        }
      });
  });

  // Bottom To Top

  $(document).ready(function () {
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 100) {
        $("#scroll-top").fadeIn();
      } else {
        $("#scroll-top").fadeOut();
      }
    });

    $("#scroll-top").on("click", function () {
      $("html, body").animate(
        {
          scrollTop: 0,
        },
        600
      );

      return false;
    });
  });

  // Coming Soon Countdown

  function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp * 1000);

    var months = [
      "Jan",

      "Feb",

      "Mar",

      "Apr",

      "May",

      "Jun",

      "Jul",

      "Aug",

      "Sep",

      "Oct",

      "Nov",

      "Dec",
    ];

    var year = a.getFullYear();

    var month = months[a.getMonth()];

    var date = a.getDate();

    var hour = a.getHours();

    var min = a.getMinutes();

    var sec = a.getSeconds();

    var time =
      date + " " + month + " " + year + " " + hour + ":" + min + ":" + sec;

    // return time;

    console.log(date);

    $("#timer #days").html(date);

    $("#timer #hours").html(hour);

    $("#timer #minutes").html(min);

    $("#timer #seconds").html(sec);
  }

  function makeTimer() {
    var endTime = new Date("September 01, 2022 00:00:00");

    var endTime = Date.parse(endTime) / 1000; //replace these two lines with the unix timestamp from the server

    var now = new Date();

    var now = Date.parse(now) / 1000;

    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);

    var hours = Math.floor((timeLeft - days * 86400) / 3600);

    var Xmas95 = new Date("December 25, 1995 23:15:30");

    // console.log(Xmas95);

    // console.log(Date.parse(timeLeft * 1000));

    var hour = Xmas95.getHours();

    // console.log(hour);

    var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);

    var seconds = Math.floor(
      timeLeft - days * 86400 - hours * 3600 - minutes * 60
    );

    if (hours < "10") {
      hours = "0" + hours;
    }

    if (minutes < "10") {
      minutes = "0" + minutes;
    }

    if (seconds < "10") {
      seconds = "0" + seconds;
    }

    $("#timer #days").html(days);

    $("#timer #hours").html(hours);

    $("#timer #minutes").html(minutes);

    $("#timer #seconds").html(seconds);
  }

  setInterval(function () {
    makeTimer();
  }, 1000);

  // Coming Soon Countdown end

  // Menu Search

  var searchIcon = document.querySelectorAll(".menu-search-click");

  var searchcloseIcon = document.querySelectorAll(".search-close");

  var searchWrap = document.querySelectorAll(".search-bar-wrap");

  searchIcon.forEach((element) => {
    element.addEventListener("click", () => {
      document.querySelectorAll(".search-bar-wrap").forEach((el) => {
        el.classList.add("show-search");
      });
    });
  });

  searchcloseIcon.forEach((element) => {
    element.addEventListener("click", () => {
      document.querySelectorAll(".search-bar-wrap").forEach((el) => {
        el.classList.remove("show-search");
      });
    });
  });

  window.onclick = function (event) {
    searchWrap.forEach((el) => {
      if (event.target == el) {
        el.classList.remove("show-search");
      }
    });
  };

  // Menu Search End

  // Custom Cursor

  var cursor = document.querySelector(".cursor");

  var cursorinner = document.querySelector(".cursor2");

  var a = document.querySelectorAll("a");

  if (cursor && cursorinner) {
    document.addEventListener("mousemove", function (e) {
      var x = e.clientX;

      var y = e.clientY;

      cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
    });

    document.addEventListener("mousemove", function (e) {
      var x = e.clientX;

      var y = e.clientY;

      cursorinner.style.left = x + "px";

      cursorinner.style.top = y + "px";
    });

    document.addEventListener("mousedown", function () {
      cursor.classList.add("click");

      cursorinner.classList.add("cursorinnerhover");
    });

    document.addEventListener("mouseup", function () {
      cursor.classList.remove("click");

      cursorinner.classList.remove("cursorinnerhover");
    });

    a.forEach((item) => {
      item.addEventListener("mouseover", () => {
        cursor.classList.add("hover");
      });

      item.addEventListener("mouseleave", () => {
        cursor.classList.remove("hover");
      });
    });
  }

  // Custom Cursor End

  // Shope Grid js

  var gridThree = document.querySelectorAll(".shop-icon-three");

  var gridTwo = document.querySelectorAll(".shop-icon-two");

  var gridRowThree = document.querySelectorAll(".shop-grid-three");

  var gridRowTwo = document.querySelectorAll(".shop-grid-two");

  gridThree.forEach((element) => {
    element.addEventListener("click", () => {
      gridThree.forEach((ele) => {
        ele.classList.add("shop-grid-active-color");
      });

      gridTwo.forEach((ele) => {
        ele.classList.remove("shop-grid-active-color");
      });
    });
  });

  gridTwo.forEach((element) => {
    element.addEventListener("click", () => {
      gridTwo.forEach((ele) => {
        ele.classList.add("shop-grid-active-color");
      });

      gridThree.forEach((ele) => {
        ele.classList.remove("shop-grid-active-color");
      });
    });
  });

  gridTwo.forEach((element) => {
    element.addEventListener("click", () => {
      gridRowThree.forEach((ele) => {
        ele.classList.add("shop-grid-none");
      });

      gridRowTwo.forEach((ele) => {
        ele.classList.remove("shop-grid-none");
      });
    });
  });

  gridThree.forEach((element) => {
    element.addEventListener("click", () => {
      gridRowTwo.forEach((ele) => {
        ele.classList.add("shop-grid-none");
      });

      gridRowThree.forEach((ele) => {
        ele.classList.remove("shop-grid-none");
      });
    });
  });

  // Shope Grid js End

  jQuery(window).on("load", function () {
    //wow Animation

    new WOW().init();

    window.wow = new WOW({
      boxClass: "wow", // default

      animateClass: "animated", // default

      offset: 0, // default

      mobile: true, // default

      live: true, // default

      offset: 100,
    });

    window.wow.init();
  });
})(jQuery);
